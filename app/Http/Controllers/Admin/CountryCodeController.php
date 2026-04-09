<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CountryCode;
use Illuminate\Http\Request;

class CountryCodeController extends Controller
{
    public function index()
    {
        $data = CountryCode::latest()->get();
        return view('admin.country_codes.index', compact('data'));
    }

    public function store(Request $request)
    {
        CountryCode::create($request->all());
        return back()->with('success','Country Code Added');
    }

    public function update(Request $request, $id)
    {
        CountryCode::find($id)->update($request->all());
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        CountryCode::find($id)->delete();
        return back()->with('success','Deleted');
    }
}