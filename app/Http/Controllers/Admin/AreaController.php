<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $data = Area::latest()->get();
        return view('admin.areas.index', compact('data'));
    }

    public function store(Request $request)
    {
        Area::create(['area'=>$request->area,'state'=>$request->state]);
        return back()->with('success','Area Added');
    }

    public function update(Request $request, $id)
    {
        Area::find($id)->update($request->only('area','state'));
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Area::find($id)->delete();
        return back()->with('success','Deleted');
    }
}