<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Imports\AreasImport;
use App\Exports\AreasExport;
use Illuminate\Pagination\Paginator;    
use Maatwebsite\Excel\Facades\Excel;

class AreaController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $areas = Area::latest()->paginate(15);
        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.areas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'area'      => 'required|string|max:255',
            'district'  => 'required|string|max:255',
            'state'     => 'required|string|max:255',
            'country'   => 'required|string|max:255',
            'area_type' => 'required|string|max:100',
        ]);

        Area::create($validated);
        return redirect()->route('admin.areas.index')->with('success', 'Area created successfully.');
    }

    public function edit(Area $area)
    {
        return view('admin.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'area'      => 'required|string|max:255',
            'district'  => 'required|string|max:255',
            'state'     => 'required|string|max:255',
            'country'   => 'required|string|max:255',
            'area_type' => 'required|string|max:100',
        ]);

        $area->update($validated);
        return redirect()->route('admin.areas.index')->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.areas.index')->with('success', 'Area deleted successfully.');
    }

    // Import view & logic
    public function importForm()
    {
        return view('admin.areas.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new AreasImport, $request->file('file'));
        return redirect()->route('admin.areas.index')->with('success', 'Areas imported successfully.');
    }

    public function export()
    {
        return Excel::download(new AreasExport, 'areas_'.date('Y-m-d').'.xlsx');
    }
}