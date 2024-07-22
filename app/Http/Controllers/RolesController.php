<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            "users" => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                "permissions" => "required"
            ]);

            $role = Role::create(['name' => $request->name]);
            if ($role) {
                $role->syncPermissions($request->permissions);
                return to_route('roles.index')->with(['success' => true, 'message' => 'Role Created Successfully']);
            }
            return back()->with(['success' => false, 'message' => 'Role Creation Failed']);
        } catch (\Exception $exception) {
            return back()->with(['success' => false, 'message' => $exception->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::query()->find($id);
        if (!$role) return response()->json('Role not found', 404);
        return response()->json(["success" => true, "data" => $role->load('permissions')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::query()->find($id);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return $this->success($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
