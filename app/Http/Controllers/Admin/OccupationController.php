<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    public function index()
    {
        $data = Occupation::latest()->get();
        return view('admin.occupations.index', compact('data'));
    }

    public function store(Request $request)
    {
        Occupation::create(['occupation'=>$request->occupation]);
        return back()->with('success','Occupation Added');
    }

    public function update(Request $request, $id)
    {
        Occupation::find($id)->update($request->only('occupation','status'));
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Occupation::find($id)->delete();
        return back()->with('success','Deleted');
    }
}