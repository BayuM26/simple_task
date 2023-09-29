<?php

namespace App\Http\Controllers;

use App\Models\m_category_task;
use App\Http\Requests\Storem_category_taskRequest;
use App\Http\Requests\Updatem_category_taskRequest;

class MCategoryTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.category',[
            'title' => 'Category',
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
     * @param  \App\Http\Requests\Storem_category_taskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storem_category_taskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function show(m_category_task $m_category_task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function edit(m_category_task $m_category_task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatem_category_taskRequest  $request
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function update(Updatem_category_taskRequest $request, m_category_task $m_category_task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function destroy(m_category_task $m_category_task)
    {
        //
    }
}