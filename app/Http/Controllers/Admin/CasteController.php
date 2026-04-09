<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caste;
use Illuminate\Http\Request;

class CasteController extends Controller
{
    public function index()
    {
        $data = Caste::latest()->get();
        return view('admin.castes.index', compact('data'));
    }

    public function store(Request $request)
    {
        Caste::create(['caste'=>$request->caste]);
        return back()->with('success','Caste Added');
    }

    public function update(Request $request, $id)
    {
        Caste::find($id)->update($request->only('caste','status'));
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Caste::find($id)->delete();
        return back()->with('success','Deleted');
    }
}