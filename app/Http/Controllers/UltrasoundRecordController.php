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
}
