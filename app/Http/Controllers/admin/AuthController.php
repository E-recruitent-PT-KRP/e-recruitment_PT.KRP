<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validasi kredensial
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerasi session
            $request->session()->regenerate();
            
            // Redirect ke dashboard atau halaman tujuan
            return redirect()->intended('/admin/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Kredensial salah.',
        ]);
    }
    

    // Menangani proses logout
    public function logout(Request $request)
{
    Auth::guard('admin')->logout(); // Logout untuk guard admin

    $request->session()->invalidate(); // Hapus session
    $request->session()->regenerateToken(); // Regenerasi token CSRF

    return redirect('/admin/login-admin'); // Redirect ke halaman login
}

}
