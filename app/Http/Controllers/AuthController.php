<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    private $RememberMe = false;

    public function ViewLogin(){
        return view('pages.loginPage',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if ($request->RememberMe == 'on') {
            $this->RememberMe = true;
        }

        if (Auth::attempt(
            [
                'username' => $request->username,
                'password' => env('PASSWORDTAMBAHAN').$request->password.env('PASSWORDTAMBAHAN'),
            ],$this->RememberMe))
        {
            $request->session()->regenerate();
 
            Alert::toast('LOGIN BERHASIL','success');
            return redirect()->intended('/beranda');
        }
 
        Alert::toast('USERNAME ATAU PASSWORD SALAH','error');
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
