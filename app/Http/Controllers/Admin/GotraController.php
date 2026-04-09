<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gotra;
use Illuminate\Http\Request;

class GotraController extends Controller
{
    public function index()
    {
        $data = Gotra::latest()->get();
        return view('admin.gotras.index', compact('data'));
    }

    public function store(Request $request)
    {
        Gotra::create(['gotra'=>$request->gotra]);
        return back()->with('success','Gotra Added');
    }

    public function update(Request $request, $id)
    {
        Gotra::find($id)->update($request->only('gotra','status'));
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Gotra::find($id)->delete();
        return back()->with('success','Deleted');
    }
}