<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public  function getQRPage(){
        return view('qr');
    }

    public function QRPayment(){

    }

    public function transferPage(){
        return view('transfer');
    }

    public function transfer(){

    }

    public function transactions(){
        $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->paginate(20);
        return view('transactions', compact('transactions'));
    }
}
