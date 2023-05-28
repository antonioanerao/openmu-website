<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a custom login request to the application.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::where('LoginName', $data['loginName'])->first();

        if($user && Hash::check($data['password'], $user->PasswordHash)) {
            try{
                auth()->loginUsingId($user->Id);
                return redirect(route('home'));
            } catch(\Exception $e) {
                return $e->getMessage();
            }
        }

        return redirect(route('login'))->withErrors(['credentials'=>'Invalid credentials'])->withInput();
    }
}
