<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    private $countTask = null;
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

    public function changePassword(){
        if (auth()->user()->hak_akses == 'Employee') {
            $this->countTask = task::where('read',0)->where('id_user',auth()->user()->id)->count();
        }
        
        return view('pages.changePassword',[
            'title' => 'Change Password',
            'countTask' => $this->countTask,
        ]);
    }

    public function changePasswordUpdate(Request $request){
        $request->validate([

        ]);

        Alert::toast('PASSWORD BERHASIL DI UBAH','success');
        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
