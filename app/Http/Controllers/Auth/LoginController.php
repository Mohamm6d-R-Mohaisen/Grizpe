<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect user after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function guard()
    // {
    //     return Auth::guard('user');
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $redirectTo = $request->input('redirect_to', url('/')); // Default to home if redirect_to is not provided
            return response()->json([
                'success' => true,
                'redirect_to' => $redirectTo,
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => ['email' => 'بيانات الدخول غير صحيحة.']
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('phone_code', 'phone', 'password');
    }

    protected function validateLogin(Request $request)
    {
        return $request->validate([
            'phone_code' => 'nullable',
            'phone' => 'required',
            'password' => 'required',
            'mac_id' => 'required',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // return $this->response_api(false, __('auth.admin.failed'),200);
        return redirect()->back()->withErrors([__('auth.admin.failed')]);
    }

    public function username()
    {
        return ['phone_code', 'phone'];
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::guard('user')->attempt(
            $this->credentials($request),
            $request->boolean('remember')
        );
    }

    public function logout(Request $request)
    {
        $cookieLifetime = 60 * 24 * 30;
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $cart = Cart::where('user_id', $user_id)->first();
    
            if ($cart) {
                $cartItems = $cart->products->map(function ($product) {
                    return [
                        'product_id' => $product->id,
                        'quantity' => $product->pivot->quantity,
                    ];
                })->toArray();
    
                // حفظ السلة في الكوكيز
                Cookie::queue('cart', json_encode($cartItems), $cookieLifetime);
            }
        }
    
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
    
        return redirect()->route('home');
    }
}
