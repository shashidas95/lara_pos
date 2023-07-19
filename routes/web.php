<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('layout.app');
});
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
//Token verify
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware(TokenVerificationMiddleware::class);


//pages routes
Route::get('/userRegistration', [UserController::class, 'UserRegistrationPage']);
Route::get('/userLogin', [UserController::class, 'UserLoginPage']);
Route::get('/sendOtp', [UserController::class, 'SendOTPCodePage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage']);
Route::get('/dashboard', [UserController::class, 'DashboardPage']);
