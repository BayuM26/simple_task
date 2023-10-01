<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\m_category_task;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\UpdatetaskRequest;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    private $taskData = null;
    private $countTask = null;
    private $taskDataDone = null;
    private $categoryData = null;
    private $userData = null;
    
    public function index()
    {
        if (auth()->user()->hak_akses == 'admin') {
            $this->userData = User::where('hak_akses','Employee')->get();
            $this->taskData = task::SearchdataTask(request(['t']))->with('m_category')->paginate(10);
            $this->categoryData = m_category_task::distinct()->get();
        }else{
            $this->taskData = task::SearchdataTask(request(['t']))->with('m_category')->where('id_user',auth()->user()->id)->where('status','inconclusive')->paginate(10);
            $this->taskDataDone = task::with('m_category')->where('id_user',auth()->user()->id)->where('status','done')->paginate(10);
            $this->countTask = task::where('read',0)->where('id_user',auth()->user()->id)->count();
            $this->categoryData = m_category_task::distinct()->get();
        }

        return view('pages.task',[
            'title' => 'Task',
            'dataTask' => $this->taskData,
            'countTask' => $this->countTask,
            'dataTaskDone' => $this->taskDataDone,
            'dataCategory' => $this->categoryData,
            'dataUser' => $this->userData,
        ]);
    }

    public function detail()
    {
        $decrypt = Crypt::decryptString(request('dt'));
        $this->countTask = task::where('read',0)->where('id_user',auth()->user()->id)->count();

        task::where('id',$decrypt)->update([
            'read' => 1,
        ]);
        
        return view('pages.detailTask',[
            'title' => 'Detail Task',
            'countTask' => $this->countTask,
            'dataTask' => task::where('id',$decrypt)->get(),
        ]);
    }

    public function doneTask()
    {
        $decrypted = Crypt::decryptString(request('d'));

        task::where('id',$decrypted)->update([
            'status' => 'done'
        ]);

        Alert::toast('TASK DONE','success');
        return redirect('/task');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'taskName' => 'required',
            'taskDeskription' => 'required',
            'category' => 'required',
            'employee' => 'required',
        ]);

        task::create([
            'id_user' => $request->employee,
            'id_category' => $request->category,
            'task_name' => $request->taskName,
            'deskrip_task' => $request->taskDeskription,
            'status' => 'inconclusive',
            'read' => 0,
        ]);

        Alert::toast('DATA BERHASIL DI TAMBAH','success');
        return redirect()->back();
    }

    public function show()
    {
        $decrypted = Crypt::decryptString(request('t'));
        return view('pages.updatePage.taskUpdate',[
            'title' => 'Update Task',
            'dataTask' => task::where('id',$decrypted)->get(),
            'dataCategory' => m_category_task::distinct()->get(),
            'dataUser' => User::where('hak_akses','Employee')->get(),
        ]);
    }

    public function edit(Request $request,$id)
    {
        $request->validate([
            'taskName' => 'required',
            'taskDeskription' => 'required',
            'category' => 'required',
            'employee' => 'required',
        ]);

        $decrypted = Crypt::decryptString($id);

        task::where('id',$decrypted)->update([
            'id_user' => $request->employee,
            'id_category' => $request->category,
            'task_name' => $request->taskName,
            'deskrip_task' => $request->taskDeskription,
        ]);

        Alert::toast('DATA BERHASIL DI UBAH','success');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        try {
            task::where('id',$request->id)->delete();
            return Response::createResponse(200,'DATA BERHASIL DI HAPUS');
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
    }
}
