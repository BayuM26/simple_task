<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Helpers\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\m_category_task;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class MCategoryTaskController extends Controller
{
    public function index()
    {
        return view('pages.category',[
            'title' => 'Category',
            'dataCategory' => m_category_task::SearchdataCategory(request(['c']))->paginate(10),
        ]);
    }

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

    public function show()
    {
        $decrypted = Crypt::decryptString(request('c'));
        return view('pages.updatePage.categoryUpdate',[
            'title' => 'Update Category',
            'dataCategory' => m_category_task::where('id',$decrypted)->get(),
        ]);
    }

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
