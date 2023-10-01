<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $countTask = null;
    public function index(){
        if (auth()->user()->hak_akses == 'Employee') {
            $this->countTask = task::where('read',0)->where('id_user',auth()->user()->id)->count();
        }
        return view('pages.contact',[
            'title' => 'Contact',
            'countTask' => $this->countTask,
        ]);
    }
}
