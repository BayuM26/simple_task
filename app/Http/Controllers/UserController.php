<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
        return view('pages.user',[
            'title' => 'User',
            'dataUser' => User::where('hak_akses','!=','admin')->paginate(10),
        ]);
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
