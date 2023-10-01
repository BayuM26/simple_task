<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\task;
use Illuminate\Http\Request;

class ApiTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getTaskdata(){
        try {
            $taskData = task::with('m_category')->paginate(request()->all());
            return Response::createResponse(200,'Data Berhasil Di Ambil',$taskData);
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
    }
}
