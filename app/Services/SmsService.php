<?php

namespace App\Services;

use Ipe\Sdk\Facades\SmsIr;

class SmsService
{
    protected $lineNumber;

    public function __construct()
    {
        $this->lineNumber = env('SMSIR_LINE_NUMBER'); // شماره خط ثابت
    }

    // ارسال پیامک گروهی
    public function sendGroup(array $mobiles, string $message)
    {
        try {
            $sendDateTime = null; // ارسال فوری
            return SmsIr::bulkSend($this->lineNumber, $message, $mobiles, $sendDateTime);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // ارسال پیامک با قالب (verify)
    public function sendWithTemplate($mobile, $templateId, array $parameters)
    {
        try {
            return SmsIr::verifySend($mobile, $templateId, $parameters);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
