<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getUserData(){
        try {
            $userData = User::paginate(request()->all());
            return Response::createResponse(200,'Data Berhasil Di Ambil',$userData);
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
    }
}
