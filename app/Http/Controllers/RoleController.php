<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Get all roles
    public function index()
    {
        return response()->json(Role::all(), 200);
    }

    // Get a single role by ID
    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        return response()->json($role, 200);
    }

    // Add a new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        return response()->json($role, 201);
    }

    // Edit an existing role
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return response()->json($role, 200);
    }

    // Delete a role
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
