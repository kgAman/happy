<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $data = Education::latest()->get();
        return view('admin.educations.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'education' => 'required'
        ]);

        Education::create($request->only('education'));
        return back()->with('success','Education Added');
    }

    public function update(Request $request, $id)
    {
        Education::findOrFail($id)->update([
            'education' => $request->education,
            'status'    => $request->status ?? 1
        ]);

        return back()->with('success','Education Updated');
    }

    public function destroy($id)
    {
        Education::findOrFail($id)->delete();
        return back()->with('success','Education Deleted');
    }
}