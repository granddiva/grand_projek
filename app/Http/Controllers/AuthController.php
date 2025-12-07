<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan Form Login
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Memproses Login
     */
    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Ambil user berdasarkan email
        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            session(['last_login' => now()]);

            return redirect()->route('posyandu.index')
                ->with('success', 'Login berhasil!');
        }

        // Jika gagal
        return back()->withInput()->withErrors([
            'email' => 'Email atau Password salah.',
        ]);
    }

    /**
     * Logout users.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
