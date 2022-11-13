<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
           
            $email=$request->get('email');
            $user=User::Where('email', $email)
            ->first();
            // dd($user);
            if($user->role=='ppic'){
                Alert::success('Login Berhasil', 'Selamat Datang');
                return redirect()->intended('/dashboard_ppic');
            }elseif($user->role=='gudang'){
                Alert::success('Login Berhasil', 'Selamat Datang');
                return redirect()->intended('/dashboard_masuk');
            }elseif($user->role=='pengadaan'){
                Alert::success('Login Berhasil', 'Selamat Datang');
                return redirect()->intended('/laporan_pemesanan');
            }elseif($user->role=='produksi'){
                Alert::success('Login Berhasil', 'Selamat Datang');
                return redirect()->intended('/laporan_mps');
            }
            
        }
        Alert::error('Login Gagal', 'Email Atau Password Salah');
        return back()->with('loginError', 'Login gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
