<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\ItemStorageService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'LoginName' => ['required', 'string', 'max:10', 'unique:pgsql.data.Account'],
            'EMail' => ['required', 'string', 'email', 'max:255', 'unique:pgsql.data.Account'],
            'SecurityCode' => ['required', 'string', 'min:6', 'max:6'],
            'PasswordHash' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'Id' => Str::uuid(),
            'VaultId' => (new ItemStorageService())->store(config('app.vault_money'))->Id,
            'LoginName' => $data['LoginName'],
            'EMail' => $data['EMail'],
            'PasswordHash' => Hash::make($data['PasswordHash']),
            'SecurityCode' => $data['SecurityCode'],
            'RegistrationDate' => now(),
            'State' => 0,
            'TimeZone' => 0,
            'VaultPassword' => '',
            'IsVaultExtended' => false
        ]);
    }
}
