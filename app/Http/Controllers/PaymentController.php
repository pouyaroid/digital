<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as PaymentGateway;

class PaymentController extends Controller
{
    /**
     * شروع پرداخت
     */
   public function pay($orderId)
{
    
    $order = Order::findOrFail($orderId);

    if ($order->payment_status === 'paid') {
        return redirect()->route('profile.index')
            ->with('error', 'این سفارش قبلا پرداخت شده است');
    }

    $invoice = (new Invoice())->amount($order->total_price);

    return PaymentGateway::callbackUrl(route('payment.verify'))->purchase(
        $invoice,
        function ($driver, $transactionId) use ($order) {
            $order->payments()->create([
                'gateway' => 'zarinpal',
                'transaction_id' => $transactionId,
                'amount' => $order->total_price,
                'status' => 'pending',
            ]);
        }
    )->pay()->render();
}
    /**
     * Callback زرین پال
     */
    public function verify(Request $request)
    {
        // dd($request->all());
        
        $authority = $request->Authority;
        $status = $request->Status;

        $payment = Payment::where('transaction_id', $authority)->first();

        if (!$payment) {

            return view('payment.result', [
                'success' => false,
                'message' => 'تراکنش یافت نشد'
            ]);
        }

        // پرداخت لغو شده
        if ($status !== 'OK') {

            $payment->update([
                'status' => 'failed'
            ]);

            return view('payment.result', [
                'success' => false,
                'message' => 'پرداخت توسط کاربر لغو شد'
            ]);
        }

        try {

            $receipt = PaymentGateway::amount($payment->amount)
                ->transactionId($payment->transaction_id)
                ->verify();

            $payment->update([
                'status' => 'success',
                'ref_id' => $receipt->getReferenceId()
            ]);

            $payment->order->update([
                'payment_status' => 'paid',
                'status' => 'pending'
            ]);

            return view('payment.result', [
                'success' => true,
                'refId' => $receipt->getReferenceId(),
                'message' => 'پرداخت با موفقیت انجام شد'
            ]);

        } catch (\Exception $e) {

            $payment->update([
                'status' => 'failed'
            ]);

            return view('payment.result', [
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}