<?php

namespace App\Http\Controllers;

use App\Models\task;

class DashboardController extends Controller
{
    private $countTask = null;
    private $count = 0;
    private $countTaskInconclusive = 0;
    private $countTaskDone = 0;
    private $persentase = null;

    public function dashboard(){
        if (auth()->user()->hak_akses == 'Employee') {
            $this->countTask = task::where('read',0)->where('id_user',auth()->user()->id)->count();

            $this->countTaskInconclusive = task::where('status','inconclusive')->where('id_user',auth()->user()->id)->count();

            $this->countTaskDone = task::where('status','done')->where('id_user',auth()->user()->id)->count();
            $this->count = task::where('id_user',auth()->user()->id)->count();
            $this->persentase = ($this->countTaskDone/$this->count)*100;
        }
        return view('pages.dashboard',[
            'title' => 'Dashboard', 
            'countTask' => $this->countTask, 
            'persentase' => $this->persentase, 
            'countTaskInconclusive' => $this->countTaskInconclusive, 
        ]);
    }
}
