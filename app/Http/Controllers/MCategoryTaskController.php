<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Helpers\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\m_category_task;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
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
            'dataCategory' => m_category_task::paginate(10),
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
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required||unique:m_category_tasks,category_name'
        ]);

        m_category_task::create([
            'category_name' => Str::ucfirst(Str::lower($request->categoryName)),
        ]);

        Alert::toast('DATA BERHASIL DI TAMBAH','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $decrypted = Crypt::decryptString(request('c'));
        return view('pages.updatePage.categoryUpdate',[
            'title' => 'Update Category',
            'dataCategory' => m_category_task::where('id',$decrypted)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\m_category_task  $m_category_task
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'categoryName' => 'required',
        ]);

        $decrypted = Crypt::decryptString($id);
        
        m_category_task::where('id',$decrypted)->update([
            'category_name' => $request->categoryName,
        ]);

        Alert::toast('DATA BERHASIL DI UBAH','success');
        return redirect()->back();
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
    public function destroy(Request $request)
    {
        try {
            m_category_task::where('id',$request->id)->delete();
            task::where('id_category',$request->id)->delete();
            return Response::createResponse(200,'Data Berhasil Di Hapus');
        } catch (\Throwable $th) {
            return Response::createResponse(500,$th->getMessage());
        }
        
    }
}
