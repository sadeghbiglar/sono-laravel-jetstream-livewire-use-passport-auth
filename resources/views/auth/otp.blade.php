<form method="POST" action="{{ route('send-otp') }}">
    @csrf
    <div>
        <label for="mobile">شماره موبایل:</label>
        <input type="text" name="mobile" id="mobile" required>
    </div>
    <button type="submit">ارسال کد OTP</button>
</form>
@if(session('status'))
    <p>{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('verify-otp.submit') }}">
    @csrf
    <div>
        <label for="otp">کد OTP:</label>
        <input type="text" name="otp" id="otp" required>
    </div>
    <button type="submit">تأیید کد OTP</button>
</form>