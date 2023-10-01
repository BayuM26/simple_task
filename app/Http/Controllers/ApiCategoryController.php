<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\m_category_task;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getCategoryData(){
        try {
            $categoryData = m_category_task::paginate(request()->all());
            return Response::createResponse(200,'Data Berhasil Di Ambil',$categoryData);
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
    }
}
