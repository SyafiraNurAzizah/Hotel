<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Kontroler ini menangani pendaftaran pengguna baru serta validasi dan pembuatan pengguna.
    | Secara default, kontroler ini menggunakan trait untuk menyediakan fungsionalitas ini tanpa memerlukan kode tambahan.
    |
    */

    use RegistersUsers;

    /**
     * Alamat URL untuk redirect setelah pendaftaran berhasil.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Buat instance kontroler baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Dapatkan validator untuk permintaan pendaftaran yang masuk.
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
        ]);
    }

    /**
     * Buat instance pengguna baru setelah pendaftaran yang valid.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_telp' => $data['no_telp'],
            'role' => 'user', // Atau sesuai dengan logika role yang Anda inginkan
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:15',
        ]);

        // Buat instance pengguna baru
        $user = $this->create($data);

        // Redirect setelah pendaftaran berhasil
        return view('index', compact('user'))->with('success', 'Pendaftaran berhasil!');
    }
}