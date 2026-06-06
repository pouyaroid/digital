<form method="POST" action="{{ route('phone.send') }}">
    @csrf

    <input type="text" name="phone" placeholder="شماره موبایل">

    <button type="submit">ارسال کد</button>
</form>