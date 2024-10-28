<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OtpVerificationController extends Controller
{
    public function show()
    {
        return view('auth.otp');
    }
    public function sendOtp(Request $request)
{
    $mobile = $request->input('mobile');

    // ارسال درخواست به API پیامک
    $response = Http::post('https://console.melipayamak.com/api/send/otp/7b4745d0c47c422ca62d27edb7426f38', [
        'to' => $mobile,
    ]);

   /*  // ارسال درخواست به API  اشتراکی پیامک
     $response = Http::post('https://console.melipayamak.com/api/send/shared/7b4745d0c47c422ca62d27edb7426f38', [
        'to' => $mobile,
        'bodyId'=>524,
        
    ]);*/
    
    if ($response->successful()) {
        $otpCode = $response->json()['code'];

       //  ذخیره شماره موبایل و کد OTP در Session برای تأیید بعدی
        session(['mobile' => $mobile, 'otp_code' => $otpCode]);
      
       
        return redirect()->route('verify-otp')->with('status', 'کد OTP ارسال شد.');
    } else {
        return back()->withErrors('مشکلی در ارسال کد OTP رخ داد.');
    }
}
public function verify(Request $request)
{
    $request->validate([
        'otp' => 'required|string',
    ]);

    $enteredOtp = $request->input('otp');
    $storedOtp = session('otp_code');
   // $storedOtp = '200200';

    // مقایسه کد وارد شده با کد ذخیره شده
    if ($enteredOtp === $storedOtp) {
        // هدایت به داشبورد در صورت صحت کد OTP
        return redirect()->route('dashboard');
    } else {
        return back()->withErrors('کد OTP نادرست است.');
    }
}


}
