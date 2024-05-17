<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $parentView = 'role';
    public function index()
    {
        $data = [];
        $data['roles'] = Role::all();

        return view($this->parentView . '.index', $data);
    }

    public function create(Request $request)
    {
        $data = [];
        $data['roles'] = Role::all()->pluck('name');
        $data['permissions'] = Permission::all();
        return view($this->parentView . '.create', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'role' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        DB::beginTransaction();
        $role = Role::create(['name' => $request->input('role')]);
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
        }

        DB::commit();
        Session::flash('success', 'Successfully  Create');
        return redirect()->back();

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        DB::beginTransaction();

        // Update the role
        $role = Role::find($id);
        $role->name = $request->input('role');
        $role->save();

        // Sync permissions if provided
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
            $role->syncPermissions($permissions);
        } else {
            // If no permissions provided, detach all permissions from the role
            $role->permissions()->detach();
        }

        DB::commit();

        // Flash success message
        Session::flash('success', 'Successfully updated role');

        return redirect()->back();
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view($this->parentView . '.show', ['role' => $role]);
    }

    public function edit($id)
    {
        $data['role'] = Role::findOrFail($id);
        $data['roles'] = Role::all()->pluck('name');
        $data['permissions'] = Permission::all();

        return view($this->parentView . '.edit', $data);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        Session::flash('success', 'Role deleted successfully.');

        return redirect()->route('role');
    }
}
