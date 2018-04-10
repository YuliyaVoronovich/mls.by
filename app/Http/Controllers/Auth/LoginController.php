<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Hash;

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
    //  protected $redirectTo = '/dashboard';

    protected $username = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    public function username()
    {
        return $this->username;
    }

    public function showLogin()
    {
        $title = 'Авторизация пользователя';
        return view('auth.login')->with(['title' => $title]);
    }

    public function authenticate(Request $request)
    {

        // dd(bcrypt($request->password));
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {

            // dd(Auth::user());
            //id сессии записывается в БД

            $user = Auth::user();
            if (!$user->ban && !$user->delete_user) {

                $user->session_id = session()->getID();
                $user->save();
                return redirect()->intended('/sales');//редирект на ту стр,откуда пришел
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
        // dd(Auth::user());
    }

    //Разлогирование
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
