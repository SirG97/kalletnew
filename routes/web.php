<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth','verified'])->group(function () {
    Route::group(['middleware' => 'registration_completed'], function(){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // Fund account
        Route::get('/fund', [App\Http\Controllers\DepositController::class, 'fund'])->name('fund');
        Route::post('/fund', [App\Http\Controllers\DepositController::class, 'initializeFund'])->name('fund.initialize');
        Route::get('/verifyFund', [App\Http\Controllers\DepositController::class, 'verifyFund'])->name('fund.verify');
        Route::get('/verifyFlutterwave', [App\Http\Controllers\DepositController::class, 'verifyFlutterwave'])->name('fund.verify.flutterwave');

        // QR Payment
        Route::get('/qrpayment', [App\Http\Controllers\TransactionController::class, 'getQRPage'])->name('QRPayment');
        Route::post('/qrpayment', [App\Http\Controllers\TransactionController::class, 'QRPayment'])->name('QRPayment.store');

        // Transfer
        Route::get('/transfer', [App\Http\Controllers\TransactionController::class, 'transferPage'])->name('transfer');
        Route::post('/transfer', [App\Http\Controllers\DepositController::class, 'transfer'])->name('transfer.store');
        // Transaction
        Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'transactions'])->name('transactions');

        // Tickets
        Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'tickets'])->name('tickets');
        Route::get('/ticket/new', [App\Http\Controllers\TicketController::class, 'newTicket'])->name('ticket.create');
        Route::post('/ticket/new', [App\Http\Controllers\TicketController::class, 'createTicket'])->name('ticket.store');
        Route::post('/ticket/comment', [App\Http\Controllers\TicketController::class, 'comment'])->name('ticket.comment');
        Route::get('/ticket/{id}', [App\Http\Controllers\TicketController::class, 'ticket'])->name('ticket.show');
        // Referrals
        Route::get('/referrals', [App\Http\Controllers\HomeController::class, 'referrals'])->name('referrals');

        // Profile and KYC
        Route::get('/profile',  [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::post('/profile',  [App\Http\Controllers\HomeController::class, 'saveProfile'])->name('profile.save');
        Route::post('/profile/image',  [App\Http\Controllers\HomeController::class, 'saveProfilePicture'])->name('profile.image');
        Route::get('/kyc',  [App\Http\Controllers\HomeController::class, 'kyc'])->name('KYC');
//        Route::get('kyc', [App\Http\Controllers\HomeController::class, 'check_kyc'])->name('kyc');
        Route::get('no-kyc', [App\Http\Controllers\HomeController::class, 'no_kyc'])->name('no-kyc');
        Route::post('upload-kyc', [App\Http\Controllers\HomeController::class, 'uploadKYC'])->name('upload-kyc');
        Route::post('upload-kyc-address', [App\Http\Controllers\HomeController::class, 'uploadProofOfAddress'])->name('upload-kyc-address');
        Route::get('/audits',  [App\Http\Controllers\HomeController::class, 'audits'])->name('audits');
        Route::get('/password',  [App\Http\Controllers\HomeController::class, 'password'])->name('password');
        Route::post('/password',  [App\Http\Controllers\HomeController::class, 'changePassword'])->name('password.change');
        Route::get('/2fa',  [App\Http\Controllers\Google2FAController::class, 'twoFA'])->name('2fa');
        Route::post('/2fa/toggle',  [App\Http\Controllers\Google2FAController::class, 'toggleTwoFA'])->name('2fa.toggle');
        Route::get('/2fa/enable',  [App\Http\Controllers\Google2FAController::class, 'enableTwoFA'])->name('2fa.enable');
        Route::get('/2fa/disable',  [App\Http\Controllers\Google2FAController::class, 'disableTwoFA'])->name('2fa.disable');
        Route::get('/2fa/validate',  [App\Http\Controllers\Google2FAController::class, 'getValidateToken'])->name('token.get');
        Route::post('/2fa/validate',  [App\Http\Controllers\Google2FAController::class, 'postValidateToken'])->name('token.post');


//        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });

    Route::get('/setup', [App\Http\Controllers\CompleteRegistration::class, 'create'])->name('setupForm');
    Route::post('/setup', [App\Http\Controllers\CompleteRegistration::class, 'store'])->name('setup');
});

