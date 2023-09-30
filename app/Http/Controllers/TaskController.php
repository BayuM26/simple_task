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
    private $categoryData = null;
    private $userData = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hak_akses == 'admin') {
            $this->taskData = task::with('m_category')->paginate(10);
            $this->userData = User::where('hak_akses','Employee')->get();
            $this->categoryData = m_category_task::distinct()->get();
        }else{
            $this->taskData = task::with('m_category')->where('id_user',auth()->user()->id)->paginate(10);
            $this->categoryData = m_category_task::distinct()->get();
        }

        return view('pages.task',[
            'title' => 'Task',
            'dataTask' => $this->taskData,
            'dataCategory' => $this->categoryData,
            'dataUser' => $this->userData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretaskRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
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
