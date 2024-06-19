<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use GuzzleHttp\Exception\ClientException;
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

    protected function redirectTo()
    {
        switch (Auth::user()->roles[0]->name) {
            case 'admin':
                return '/admin';
                break;
            
            case 'marketing':
                return '/admin';
                break;

            case 'superadmin':
                return '/admin';
                break;
            
            default:
                return '/';
                break;
        }
    }

    public function redirectToProvider()
    {
        try {
            return Socialite::driver('google')->redirect();
        }
        catch (ClientException $e) {
            Log::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function handleProviderCallback()
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            if($user != null){
                \auth()->login($user, true);
                return redirect()->route('home');
            }else{
                $user = \App\Models\User::create([
                    'uuid' => Str::uuid(),
                    'email' => $user_google->getEmail(),
                    'name' => $user_google->getName(),
                    'username' => $user_google->getName(),
                    'google_id' => $user_google->getId(),
                    'avatar' => $user_google->getAvatar(),
                    'password' => 0,
                    'email_verified_at' => now()
                ]);

                $user->assignRole('user');

                Auth::login($user);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), 'Kesalahan Server!');
            return redirect()->route('login');
        }
    }
}
