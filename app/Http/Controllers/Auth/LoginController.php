<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Override logout method if needed
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau kata sandi salah.');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect($this->redirectTo); // Selalu alihkan ke '/'
    }
}
