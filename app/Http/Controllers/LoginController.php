<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Jadi, ketika Anda menulis "use Illuminate\Http\Request"
// , Anda sedang memberi tahu PHP bahwa Anda ingin menggunakan kelas Request
// yang ada di dalam ruang nama Illuminate\Http. Dengan melakukan ini
// , Anda dapat membuat objek dari kelas Request dan menggunakannya untuk
// mengakses informasi tentang permintaan HTTP yang saat ini
// sedang diolah oleh aplikasi Laravel Anda.
use Illuminate\Http\RedirectResponse;
// Illuminate\Http\RedirectResponse" adalah kelas yang digunakan dalam Laravel
// untuk membuat respons yang mengarahkan (redirect) pengguna ke halaman atau
// URL lain setelah suatu tindakan selesai
use Illuminate\Support\Facades\Auth;
// Dengan menggunakan "use Illuminate\Support\Facades\Auth," Anda dapat dengan mudah
// mengakses bagian depan Auth dan menggunakan berbagai metode otentikasi yang disediakan
// oleh Laravel untuk mengelola otentikasi pengguna dalam aplikasi Anda

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
