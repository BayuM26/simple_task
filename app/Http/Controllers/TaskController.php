<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\m_category_task;
use App\Http\Requests\StoretaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.task',[
            'title' => 'Task',
            'dataTask' => task::with('m_category')->paginate(10),
            'dataCategory' => m_category_task::distinct()->get(),
            'dataUser' => User::where('hak_akses','Employee')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetaskRequest  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetaskRequest $request, task $task)
    {
        //
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
