<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('pages.user',[
            'title' => 'User',
            'dataUser' => User::paginate(10),
        ]);
    }
}
