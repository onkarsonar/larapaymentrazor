<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

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


Route::get('/pay', [PaymentController::class, 'pay']);
Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/verify-payment', [PaymentController::class, 'verifyPayment'])->name('verify.payment');
Route::get('/payment-result', [PaymentController::class, 'paymentResult'])->name('payment.result');

Route::get('/', function () {
    return view('welcome');
});
