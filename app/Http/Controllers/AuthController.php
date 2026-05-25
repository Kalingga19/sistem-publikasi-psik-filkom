<?php //controller auth (login, register, logout)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Berhasil login, selamat datang!');
            }

            return redirect()->route('user.dashboard')
                ->with('success', 'Berhasil login, selamat datang!');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // proses register
    public function register(Request $request)
    {
    $request->validate([
    'name'     => 'required|string|max:255',
    'nim'      => 'required|numeric|unique:users,nim',
    'email'    => 'required|email|ends_with:student.ub.ac.id|unique:users,email',
    'password' => 'required|min:8',
    ], [
    'email.ends_with' => 'Gunakan email UB (@student.ub.ac.id)!',
    'email.unique'    => 'Email sudah digunakan!',
    'nim.unique'   => 'NIM sudah terdaftar!',
    ]);
        User::create([
            'name'     => $request->name,
            'nim'      => $request->nim,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // otomatis user
        ]);

        return redirect('/login')->with('success', 'Register berhasil, silakan login');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout. Sampai jumpa lagi!');
    }
}