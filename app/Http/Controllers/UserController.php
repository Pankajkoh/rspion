<?php

namespace App\Http\Controllers;

use App\Mail\SendOTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function requestOtp(Request $request)
    {
        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);
        $user = User::where('email','=',$request->email)->update(['otp' => $otp]);

        if($user){
            Mail::to($request->email)->send(new SendOTP($user));

            return response(["status" => 200, "message" => "OTP sent successfully"]);
        }
        else{
            return response(["status" => 401, 'message' => 'Invalid']);
        }
    }

    public function verifyOtp(Request $request){

        $user  = User::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
        if($user){
            auth()->login($user, true);
            User::where('email','=',$request->email)->update(['otp' => null]);
            //$accessToken = auth()->user()->createToken('authToken')->accessToken;

            //return response(["status" => 200, "message" => "Success", 'user' => auth()->user(), 'access_token' => $accessToken]);
            return response(["status" => 200, "message" => "Success", 'user' => auth()->user()]);
        }
        else{
            return response(["status" => 401, 'message' => 'OTP verification failed']);
        }
    }
}
