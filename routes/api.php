<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Payament info
Route::post('/payment/notify', [PaymentController::class, 'getPaymentInfo']);
