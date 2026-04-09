<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Manage Permissions');
    }
    
    public function index()
    {
        $permissions = Permission::orderBy('type')->orderBy('name')->get()->groupBy('type');
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|unique:permissions', 'type' => 'required|string']);
        Permission::create($data);
        return redirect()->route('admin.permissions.index')->with('success','Permission added');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success','Permission deleted');
    }
}
