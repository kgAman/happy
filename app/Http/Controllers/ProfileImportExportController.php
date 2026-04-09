<?php

namespace App\Http\Controllers;

use App\Exports\ProfilesExport;
use App\Imports\ProfilesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProfileImportExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ProfilesExport, 'profiles.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new ProfilesImport, $request->file('file'));

        return back()->with('success', 'Profiles imported successfully');
    }
}