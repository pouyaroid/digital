<form method="POST" action="{{ route('otp.verify') }}">
    @csrf

    <input type="hidden" name="phone" value="{{ $phone }}">

    <input type="text" name="code" placeholder="کد تایید">

    <button type="submit">ورود</button>
</form>