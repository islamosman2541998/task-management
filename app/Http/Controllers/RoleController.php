<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function assignPermission(Request $request, $roleId)
{
    $validated = $request->validate([
        'permission_id' => 'required|exists:permissions,id',
    ]);

    $role = Role::find($roleId);

    if (!$role) {
        return response()->json(['message' => 'Role not found'], 404);
    }

    $role->permissions()->attach($validated['permission_id']);

    return response()->json(['message' => 'Permission assigned to role successfully']);
}


    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create(['name' => $validated['name']]);

        return response()->json(['role' => $role, 'message' => 'Role created successfully'], 201);
    }

    public function show($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $validated['name']]);

        return response()->json(['role' => $role, 'message' => 'Role updated successfully']);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully']);
    }
}
