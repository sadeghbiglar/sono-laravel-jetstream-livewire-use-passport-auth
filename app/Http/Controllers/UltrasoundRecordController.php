<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Pail\ValueObjects\Origin\Console;

class UltrasoundRecordController extends Controller
{
    public function create()
    {
        return view('ultrasound.create');
    }

    public function store(Request $request)
    {
        //dd(auth()->user()->api_token);
        $accessToken = session('api_token');
    
        // ارسال درخواست به API اصلی برای ثبت اطلاعات
       // $response = Http::withToken(auth()->user()->api_token)
       $response = Http::withToken($accessToken)
        ->post(env('API_BASE_URL') . '/api/ultrasound-records', $request->all());
        if ($response->successful()) {
            return redirect()->route('dashboard')->with('success', 'Record created successfully');
            
     }
     
        return back()->withErrors('Failed to create record');
    }
    public function fetchData(Request $request)
    {
        // گرفتن مقدار ID از درخواست
        $id = $request->input('id');

        // ارسال درخواست به API خارجی
        $response = Http::get("https://apitester.ir/api/Categories/{$id}");

        // چک کردن وضعیت پاسخ
        if ($response->successful()) {
            // بازگرداندن نتیجه به صفحه
            return back()->with('result', $response->json());
        } else {
            // مدیریت خطاها
            return back()->withErrors('مشکلی در فراخوانی API رخ داده است.');
        }
    }

    public function fetchData_auth(Request $request)
    {
        $accessToken = session('api_token');
        
        // گرفتن مقدار ID از درخواست
        $id = $request->input('idd');
       
        // ارسال درخواست به API خارجی
        $response = Http::withToken($accessToken)->get("https://apitester.ir/api/CategoriesWithTokenAuth/{$id}");
       /*  $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://apitester.ir/api/CategoriesWithTokenAuth/{$id}"); */
        // dd($response);
        // چک کردن وضعیت پاسخ
        if ($response->successful()) {
            // بازگرداندن نتیجه به صفحه
            return back()->with('result', $response->json());
        } else {
            // مدیریت خطاها
            return back()->withErrors('مشکلی در فراخوانی API رخ داده است.');
        }
    }
}
