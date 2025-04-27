<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('auth.passwords.phone');
    }

    public function sendResetOTPCode(Request $request)
    {
        $this->validatePhone($request);
        
        $user = User::where('phone_code', $request->phone_code)->where('phone', $request->phone)->first();
        if($user){
            // send otp to the phone number
            $phone = $request->phone_code . $request->phone;
            $otp = $this->sendOTP($phone);
            // $otp = '1234'; 

            $data['otp'] = $otp;
            $data['otp_expired_at'] = Carbon::now()->addMinutes(60);
            $user->update($data);
        }

        $phone = $request->phone;
        $phone_code = $request->phone_code;
        return view('auth.passwords.otp', compact('phone', 'phone_code'));
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone_code' => 'nullable|numeric',
            'phone' => 'required|numeric',
            'password' => 'required|min:6|max:25',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }

        try{
            $user = User::where('phone_code', $request->phone_code)->where('phone', $request->phone)->first();

            if($user->otp_expired_at <= Carbon::now()){
                return $this->sendError('OTP is expired');
            }

            if($user->otp !== $request->otp){
                return $this->sendError(__('auth.otp_is_not_correct'));
            }

            $user->update([
                'status' => 1,
            ]);
            
            return $this->response_api(200, __('auth.success'), '');
        } catch (Exception $e) {
            return $this->sendError($this->exMessage($e));
        }
    }
    protected function validatePhone(Request $request)
    {
        $this->validate($request, [
            'phone_code' => 'required',
            'phone'      => 'required|digits_between:9,13',
        ]);
    }
}
