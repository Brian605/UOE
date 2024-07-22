<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AssignRoleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'roles' => 'required'
        ]);
        $user = User::query()->find($request->userId);

        $roles = $user->assignRole($request->roles);
        if ($roles) return to_route('roles.index')->with(['success' => true, 'message' => 'Roles Assigned Successfully']);
        return back()->with(['success' => false, 'message' => 'Roles Assignment Failed']);
    }
}
