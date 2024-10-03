<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Pastikan Request yang digunakan adalah dari Illuminate\Http\Request

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
        return redirect('/'); // Redirect ke halaman yang diinginkan setelah logout
    }

    // Override method untuk menangani login yang gagal
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email')) // Memastikan email yang di-input tetap tampil
            ->with('error', 'Email atau password salah.'); // Mengirim flash message error
    }
}
