<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/form-login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        // var_dump($request->email);
        // var_dump($request->password);
        // die;
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }
    // Dengan demikian, metode authenticate ini berfungsi untuk memvalidasi
    // kredensial pengguna, mengautentikasi mereka, dan mengarahkan mereka ke
    // halaman yang sesuai tergantung pada hasil autentikasi. Jika autentikasi gagal
    // , pesan kesalahan akan ditampilkan kepada pengguna.

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
