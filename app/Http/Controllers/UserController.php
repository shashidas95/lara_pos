<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function UserRegistrationPage()
    {
        return view('pages.auth.registration-page');
    }
    public function UserLoginPage()
    {
        return view('pages.auth.login-page');
    }
    public function SendOTPCodePage()
    {
        return view('pages.auth.send-otp-page');
    }
    public function VerifyOTPPage()
    {
        return view('pages.auth.verify-otp-page');
    }
    public function ResetPasswordPage()
    {
        return view('pages.auth.reset-password-page');
    }
    public function DashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }


    public function UserRegistration(Request $request)
    {



        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            return response()->json([
                'status' => "success",
                'message' => "User registration successful"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => "fail",
                'message' => "User registration Failed"
                // 'message' => $e->getMessage()
            ]);
        }
    }
    public function UserLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();
        if ($count == 1) {
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => "success",
                'message' => "User login successful",
            ])->cookie('token', $token, 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "unauthorised"
            ]);
        }
    }
    public function SendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();
        if ($count == 1) {
            Mail::to($email)->send(new OTPMail($otp));
            User::where('email', '=', $email)->update(['otp' => $otp]);
            return response()->json([
                'status' => "success",
                'message' => "Four digit otp code is sent to your email account"
            ]);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "unauthorised"
            ]);
        }
    }
    public function VerifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();
        if ($count === 1) {
            $token = JWTToken::CreateTokenForSetPassword($email);
            User::where('email', '=', $email)->update(['otp' => '0']);
            return response()->json([
                'status' => "success",
                'message' => "OTP code verified successfully",
            ])->cookie('token', $token, 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => "fail",
                'message' => "unauthorised"
            ]);
        }
    }
    public function ResetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => "success",
                'message' => "Password reset is successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => "fail",
                'message' => $e->getMessage()
            ]);
        }
    }
}
