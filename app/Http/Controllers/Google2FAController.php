<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;
use ParagonIE\ConstantTime\Base32;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

class Google2FAController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function twoFA(){
        $data['title']='Two Factor Authentication';
        $g = new GoogleAuthenticator();
        $secret = $g->generateSecret();
        $user = auth()->user();
        $site = config('app.name', 'Kallet');
        $data['secret'] = $secret;
        $data['image'] = GoogleQrUrl::generate($user->email, $secret, $site);
        return view('2fa', compact('user', 'data'));
    }

    public function toggleTwoFA(Request $request){

        $user = User::findOrFail(auth()->user()->id);
        $g = new GoogleAuthenticator();
        $secret = $request->vv;
        if ($request->type==0) {

            $check=$g->checkcode($user->googlefa_secret, $request->code, 3);
            if($check){
                $user->fa_status = 0;
                $user->googlefa_secret = null;
                $user->save();

                $audit['user_id'] = auth()->user()->id;
                $audit['reference'] = Str::random(10);
                $audit['log']='Deactivated 2fa';
                Audit::create($audit);
//                if($set['email_notify']==1){
//                    send_email($user->email, $user->username, 'Dear Customer, <br/><br/>Two Factor Security Disabled', ' 2FA security on your account was just disabled, contact us immediately if this was not done by you.');
//                }
                return back()->with('success', '2fa disabled successfully.');
            }else{
                return back()->with('alert', 'Invalid code.');
            }
        }else{

            $check = $g->checkcode($secret, $request->code, 3);
            if($check){
                $user->fa_status = 1;
                $user->googlefa_secret = $request->vv;
                $user->save();
                Session::put('fakey', $secret);
//                $set=Settings::first();
                $audit['user_id'] = auth()->user()->id;
                $audit['reference']= Str::random(16);
                $audit['log']='Activated 2fa';
                Audit::create($audit);
//                if($set['email_notify']==1){
//                    send_email($user->email, $user->username, 'Dear Customer, <br/><br/>Two Factor Security Enabled', ' 2FA security on your account was just enabled, contact us immediately if this was not done by you.');
//                }
                return back()->with('success', '2fa enabled.');
            }else{
                return back()->with('error', 'Invalid code.');
            }
        }
    }

    /**
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function enableTwoFA(Request $request)
    {
        //generate new secret
        $secret = $this->generateSecret();

        //get user
        $user = $request->user();

        //encrypt and then save secret
        $user->googlefa_secret = Crypt::encrypt($secret);
        $user->save();

        //generate image for QR barcode
        $imageDataUri = Google2FA::getQRCodeInline(
            $request->getHttpHost(),
            $user->email,
            $secret,
            200
        );

        return view('2fa', ['image' => $imageDataUri,
            'secret' => $secret]);
    }

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function disableTwoFA(Request $request)
    {
        $user = $request->user();

        //make secret column blank
        $user->googlefa_secret = null;
        $user->save();

        return view('2fa/disableTwoFactor');
    }

    /**
     * Generate a secret key in Base32 format
     *
     * @return string
     * @throws \Exception
     */
    private function generateSecret()
    {
        $randomBytes = random_bytes(10);

        return Base32::encodeUpper($randomBytes);
    }
}
