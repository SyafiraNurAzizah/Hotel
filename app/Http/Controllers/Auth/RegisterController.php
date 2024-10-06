<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
        ], [
            'firstname.required' => 'Nama depan wajib diisi.',
            'lastname.required' => 'Nama belakang wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Password anda tidak cocok.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.max' => 'Nomor telepon maksimal 15 karakter.',
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
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_telp' => $data['no_telp'],
            'role' => 'user',
        ]);

        // Login otomatis setelah pendaftaran
        Auth::login($user); // Tambahkan baris ini

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function register(Request $request)
    {
        // Validasi input
        $this->validator($request->all())->validate();

        // Periksa apakah password dan konfirmasi password cocok
        if ($request->password !== $request->password_confirmation) {
            return $this->sendFailedRegistrationResponse($request);
        }

        $user = $this->create($request->all());

        return $this->registered($request, $user);
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo); // Redirect ke halaman yang diinginkan setelah login
    }

    protected function sendFailedRegistrationResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('firstname', 'lastname', 'email', 'no_telp'))
            ->withErrors(['password' => 'Password dan konfirmasi password tidak cocok.']); // Menggunakan withErrors
    }
}
