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

Route::group(['prefix' => 'admin', 'middleware' => 'can.access.backoffice'], function () {
    Route::get('/', [BackofficeController::class, 'index'])->name('admin');
    Route::get('/camp', [BackofficeController::class, 'camp'])->name('backoffice.camp');
    Route::get('/bbq', [BackofficeController::class, 'bbq'])->name('backoffice.bbq');
    Route::get('/camp/participant', [BackofficeController::class, 'camp_participant'])->name('backoffice.camp.participant');
    Route::post('/camp/participant', [BackofficeController::class, 'confirm_camp_participant']);
    Route::get('/camp/scanner', function(){ return view ('backoffice.scanner'); })->name('backoffice.scanner');
    Route::get('/bbq/participant', [BackofficeController::class, 'bbq_participant'])->name('backoffice.bbq.participant');
    Route::get('/pos/products', function(){ return view ('backoffice.pos.products'); })->name('backoffice.pos.products');
    Route::get('/pos/products/add', [BackofficeController::class, 'addproduct_view'])->name('backoffice.pos.products.add');
    Route::post('/pos/products/add', [BackofficeController::class, 'product_add']);
    Route::get('/pos/products/edit', [BackofficeController::class, 'product_edit'])->name('backoffice.pos.products.edit');
    Route::post('/pos/products/edit', [BackofficeController::class, 'product_edit_save']);
    Route::post('/pos/products', [BackofficeController::class, 'product_delete'])->name('backoffice.pos.products.delete');
    Route::post('/checkin', [BackofficeController::class, 'check_in'])->name('backoffice.checkin');
    Route::post('/checkout', [BackofficeController::class, 'check_out'])->name('backoffice.checkout');
});
