<?php
namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Manage Users');
    }

    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','id');
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role_id' => 'required'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $user->syncRoles([Role::find($data['role_id'])]);

        return redirect()->route('admin.users.index')->with('success','User created!');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','id');
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required',
        ]);

        $user->update($data);

        $user->syncRoles([Role::find($data['role_id'])]);

        return redirect()->route('admin.users.index')->with('success','Updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User deleted');
    }
}
