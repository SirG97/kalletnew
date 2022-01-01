<?php

namespace App\Http\Controllers;

use App\Models\Logo;
//use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CompleteRegistration extends Controller
{

    public function __construct()
    {
//        $set = Setting::first();
//        $logo = Logo::first();
//        View::share('set', $set);
//        View::share('title', $set->title);
//        View::share('logo', $logo);
    }

    public function create(){
        return view('auth.setup');
    }

    public function store(Request $request){
        $request->validate([
            'dob' => ['required', 'date'],
            'phone' => ['required', 'numeric', 'digits_between:11,13'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required'],
            'currency' => ['required',],
            'pin' => ['required', 'numeric', 'digits_between:0000,9999', 'confirmed'],
        ]);

        $user_id = Str::random(8);
        $qr_code = QrCode::size(300)->style('round')->errorCorrection('H')->generate( env('APP_URL') .'/user/' . $user_id);
        $location = '/img/qrcode/user/' . $user_id . '.svg';
        Storage::disk('public')->put($location, $qr_code);

        auth()->user()->update([
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'currency' => $request->currency,
            'pin' => $request->pin,
            'user_id' => $location,
        ]);


        return redirect()->route('home');
    }
}
