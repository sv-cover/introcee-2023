<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CampRegistrationController;
use \App\Http\Controllers\BarbecueController;
use \App\Http\Controllers\WalletController;
use \App\Http\Controllers\EmailController;
use \App\Http\Middleware\CanAccessBackoffice;
use \App\Http\Controllers\BackofficeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('home');
})->name('home');

Route::get('/camp', function() {
    return view('camp');
})->name('camp');

Route::get('/committee', function() {
    return view('committee');
})->name('committee');

Route::get('/camp/signup', [CampRegistrationController::class, 'view'])->name('campregistration');
Route::post('/camp/signup/firstyear', [CampRegistrationController::class, 'sign_up_first_year'])->name('campregistration.firstyear');
Route::post('/camp/signup/senior', [CampRegistrationController::class, 'sign_up_senior'])->name('campregistration.senior');

Route::get('/camp/confirm', [CampRegistrationController::class, 'confirm'])->name('campregistration.confirm');

Route::get('/payment', [PaymentController::class, 'view'])->name('payment');
Route::post('/payment', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/barbecue', [BarbecueController::class, 'view'])->name('barbecue');
Route::post('/barbecue/firstyear', [BarbecueController::class, 'sign_up_first_year'])->name('bbqregistration.firstyear');
Route::post('/barbecue/senior', [BarbecueController::class, 'sign_up_senior'])->name('bbqregistration.senior');

Route::get('/wallet', [WalletController::class, 'view'])->name('wallet');
Route::get('/wallet/topup', [WalletController::class, 'topUpView'])->name('topup');
Route::post('/wallet/topup', [WalletController::class, 'toPayment'])->name('topup.payment');

Route::get('/email', function() {
    return view('emails.standard');
})->name('email');

Route::prefix('admin')->group(function() {
    Route::get('/', [BackofficeController::class, 'index'])->name('admin');
    Route::get('/camp', [BackofficeController::class, 'camp'])->name('backoffice.camp');
    Route::get('/bbq', [BackofficeController::class, 'bbq'])->name('backoffice.bbq');
    Route::get('/camp/participant', [BackofficeController::class, 'camp_participant'])->name('backoffice.camp.participant');
    Route::get('/bbq/participant', [BackofficeController::class, 'bbq_participant'])->name('backoffice.bbq.participant');
})->middleware(CanAccessBackoffice::class);
