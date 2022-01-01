<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function fund(){

        return view('fund');
    }

    public function initializeFund(Request $request){
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        // Create a deposit log to check against when the transaction is to be verified
        $deposit = Deposit::create([
            'trx_ref' => Str::random(12),
            'amount' => $request->amount * 100,
            'email' => auth()->user()->email,
            'user_id' => auth()->user()->id,
            'status' => 'pending'
        ]);
        $url = "https://api.paystack.co/transaction/initialize";
        $fields = [
            'email' => auth()->user()->email,
            'amount' => $request->amount * 100,
            'reference' => $deposit->trx_ref,
            'callback_url' => route('fund.verify')
        ];

        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_test_e7621281de1a1b6e1f4549b8741adb52fc89255e",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $result = json_decode($result);
        if($result && $result->status === true){
            return redirect($result->data->authorization_url);
        }else{
            dd($result);
        }
    }

    public function verifyFund(Request $request){
        $reference = $request->reference;

        $deposit = Deposit::where('trx_ref', $reference)->first();

        if($deposit == null){
            return redirect(route('fund'))->with('error', "Something went wrong, please try again");
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_e7621281de1a1b6e1f4549b8741adb52fc89255e",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return redirect(route('fund'))->with('error', "Error #:" . $err);
        } else {
            $response = json_decode($response);
//            dd($response);
            if($response->status !== true){
                return redirect(route('fund'))->with('error', "Error #:" . $response->message);
            }

            if($response->status === true){
                if((int)$deposit->amount === (int)$response->data->amount and
                    $deposit->trx_ref === $response->data->reference){
                    $deposit->status = 'success';
                    $deposit->save();
                    $amount = $response->data->amount/100;
                    // Check if the user has a wallet
                    $wallet = Wallet::where('user_id', auth()->user()->id)->first();
                    $balance_before = 0;
                    if($wallet !== null){
                        // Update balance
                        $balance_before = $wallet->balance;
                        $wallet->balance = $wallet->balance + $amount;
                        $wallet->save();
                    }else{
                        $wallet = Wallet::create([
                            'user_id' => auth()->user()->id,
                            'balance' => $amount
                        ]);
                    }
                    // Add record to the transaction table

                    Transaction::create([
                        'user_id' => auth()->user()->id,
                        'trx_ref' => Str::random(10),
                        'txn_type' => 'credit',
                        'purpose' => 'deposit',
                        'amount' => $amount,
                        'balance_before' => $balance_before,
                        'balance_after' => $balance_before + $amount
                    ]);

                    return redirect(route('fund'))->with('success', "Account funded successfully");
                }
            }
        }
    }

    public function transfer(Request $request){
        // Validate
        $request->validate([
            'username' => 'required|max:255',
            'amount' => 'required|numeric'
        ]);

        // Check if the user exist and not himself
        $userToCredit = User::where('username', $request->username)->first();
        if(!$userToCredit){
            return back()->with('error', 'User with the username does not exist');
        }

        if($userToCredit->username === auth()->user()->username){
            return back()->with('error', 'You cannot transfer to yourself');
        }
        //Check for insufficient balance
        $userToDebit = Wallet::where('user_id', auth()->user()->id)->first();
        if(!$userToDebit or $userToDebit->balance < $request->amount){
            return back()->with('error', 'Insufficient balance');
        }
        // Debit the creditor
        $balance_before = $userToDebit->balance;
        $userToDebit->balance = $userToDebit->balance - $request->amount;
        $debitTransaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'trx_ref' => Str::random(10),
            'txn_type' => 'debit',
            'purpose' => 'transfer',
            'amount' => $request->amount,
            'balance_before' => $balance_before,
            'balance_after' => $userToDebit->balance - $request->amount,
            'metadata' => ['description' => $request->description,
                            'short_desc' => 'Transfer to '. $userToCredit->username,
                            'transfer_to' => $userToCredit->username],
        ]);
        $userToDebit->save();
        // Credit the intended user
        $userToCreditWallet = Wallet::where('user_id', $userToCredit->id)->first();
        $userToCreditWallet->balance = $userToCreditWallet->balance + $request->amount;

        $creditTransaction = Transaction::create([
            'user_id' => $userToCredit->id,
            'trx_ref' => Str::random(10),
            'txn_type' => 'credit',
            'purpose' => 'transfer',
            'amount' => $request->amount,
            'balance_before' => $userToCreditWallet->balance,
            'balance_after' => $userToCreditWallet->balance - $request->amount,
            'metadata' => ['description' => 'Credit transfer',
                            'short_desc' => 'Transfer from '. $userToDebit->username,
                            'transfer_from' => $userToDebit->username],
        ]);
//        $userTo+=codetograceheart be good be kind be faithful be smart be handsome and be Godly
        $userToCreditWallet->save();
        // Check if he has a wallet already
        return back()->with('success', $userToCredit->username . ' has been credited successfully');

    }
}
