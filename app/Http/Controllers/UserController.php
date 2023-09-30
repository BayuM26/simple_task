<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
        return view('pages.user',[
            'title' => 'User',
            'dataUser' => User::where('hak_akses','!=','admin')->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required||min:5',
            'position' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'hak_akses' => $request->position,
        ]);
        
        Alert::toast('DATA BERHASIL DI TAMBAH','success');
        return redirect()->back();
    }

    public function show()
    {
        $decrypted = Crypt::decryptString(request('u'));
        return view('pages.updatePage.userUpdate',[
            'title' => 'Update User',
            'dataUser' => User::where('id',$decrypted)->get(),
        ]);
    }

    public function edit(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'position' => 'required',
        ]);

        $decrypted = Crypt::decryptString($id);
        
        User::where("id",$decrypted)->update([
            'name' => $request->name,
            'username' => $request->username,
            'hak_akses' => $request->position,
        ]);

        Alert::toast('DATA BERHASIL DI UBAH','success');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        try {
            User::where('id',$request->id)->delete();
            return Response::createResponse(200,'Data Berhasil Di Hapus');
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
    }
}
