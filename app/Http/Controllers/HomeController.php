<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->take(10)->get();
        return view('home', compact('transactions'));
    }

    public function profile(){
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function saveProfile(Request $request)
    {
        $id = auth()->user()->id;
        //        dd($request->email, $request->address, $request->phone);
        $request->validate([
            'email' => 'required|unique:users,email,' . $id,
            'address' =>'required|max:255',
            'phone' =>'required|max:255',
            'dob' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->address = $request->address;
//        $user->dob = $request->dob;
        $user->phone = $request->phone;
        if($user->email!=$request->email){
            $user->email_verified_at = NULL;
        }
        $user->save();

        Audit::create([
            'user_id' => $id,
            'reference' => Str::random(10),
            'log' => 'Updated account details'
        ]);
        return back()->with('success', 'Profile Updated Successfully.');
    }

    public function saveProfilePicture(Request $request){
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if(auth()->user()->photo !== null or !empty(auth()->user()->photo)){
            Storage::disk('public')->delete(auth()->user()->photo);
        }
        $url =  Storage::disk('public')->put('profile', $request->photo);

        auth()->user()->update([
            'photo' => $url,
        ]);

        return back()->with('success', 'Profile picture uploaded successfully');
    }

    public function audits()
    {
        $data['title']='Audit Logs';
        $data['audit']=Audit::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('audit', $data);
    }

    public function no_kyc()
    {
        if (Auth::guard()->user()->kyc_status==1) {
            return redirect()->route('user.dashboard');
        } else {
            $data['title'] = "Know your customer";
            return view('kyc', $data);
        }
    }
    public function check_kyc()
    {
        $data['title'] = "Know your customer";
        $data['user'] = auth()->user();
        // $data['set'] = Setting::first();
        $data['logo'] = $this->logo();
//        $site = $set->site_name;
        return view('no-kyc', $data);
    }

    public function kyc(){
        $user = auth()->user();
        return view('kyc', compact('user'));
    }

    public function uploadKYC(Request $request){
        $request->validate([
            'id_type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if(auth()->user()->kyc_link !== null or !empty(auth()->user()->kyc_link)){
            Storage::disk('public')->delete(auth()->user()->kyc_link);
        }
        $url =  Storage::disk('public')->put('kyc', $request->image);

        auth()->user()->update([
            'kyc_type' => $request->id_type,
            'kyc_link' => $url,
        ]);

        return back()->with('success', 'ID uploaded successfully');
    }

    public function uploadProofOfAddress(Request $request){
        $request->validate([
            'kyc_address_link' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if(auth()->user()->kyc_address_link !== null or !empty(auth()->user()->kyc_address_link)){
            Storage::disk('public')->delete(auth()->user()->kyc_address_link);
        }
        $url =  Storage::disk('public')->put('address', $request->kyc_address_link);

        auth()->user()->update([
            'kyc_address_link' => $url,
        ]);

        return back()->with('success', 'Proof of address uploaded successfully');
    }

    public function referrals(){
        $referrals = Auth::user()->referrals->count();
        $data['earning'] = [];
        $data['referral'] = [];
        return view('referrals', compact('referrals', 'data'));
    }

    public function password(){
        $devices = User::find(auth()->user()->id)->authentications;
        return view('password', compact('devices'));
    }

    public function changePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::where('id',auth()->user()->id)->first();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            $audit['user_id']= Auth::guard()->user()->id;
            $audit['reference']=Str::random(16);
            $audit['log']='Changed Password';
            Audit::create($audit);
            return back()->with('success', 'Password Changed successfully.');
        }elseif (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Wrong password');
        }
    }

    public function changePin(Request $request){
        $request->validate([
            'old_pin' => 'required',
            'pin' => 'required|numeric|digits_between:0000,9999|confirmed'
        ]);
        $user = User::where('id',auth()->user()->id)->first();
        if ($request->old_pin === $user->pin) {
            $user->pin = $request->pin;
            $user->save();
            $audit['user_id']= Auth::guard()->user()->id;
            $audit['reference']=Str::random(16);
            $audit['log']='Changed Pin';
            Audit::create($audit);
            return back()->with('success', 'Pin Changed successfully.');
        }elseif ($request->pin !== $user->pin) {
            return back()->with('error', 'Wrong pin');
        }
    }



}
