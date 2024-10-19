<?php
namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;
use App\Models\User;
class AuthenticateUser
{
    public function __invoke(Request $request)
    {
        // ارسال درخواست به API برای احراز هویت
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            // احراز هویت موفق
            $userData = $response->json();

            // بازیابی یا ایجاد کاربر
            $user = User::firstOrCreate(
                ['email' => $userData['user']['email']],
                [
                    'name' => $userData['user']['name'],
                    'password' => bcrypt('default-password'), // رمز عبور پیش‌فرض
                ]
            );

            // ورود کاربر به سیستم
            return $user; // اینجا شیء کاربر را بازگردانید
        }

        // در صورت عدم موفقیت
        return null; // بازگرداندن null به معنای احراز هویت ناموفق
    }
}
