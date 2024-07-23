<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Users.index', [
            'users' => User::all(),
            "roles" => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $user = User::query()->create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => bcrypt($request->password)
        ]);

        if ($user)
        {
            $user->assignRole([$request->roleId]);
            return to_route('users.index')->with([
                'message' => 'User created successfully',
                "success" => true
            ]);
        }
        return back()->with([
            'message' => 'User creation failed',
            "success" => false
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);
        if ($user->update($request->all()))
        {
            return to_route('users.index')->with([
                'message' => 'User updated successfully',
                "success" => true
            ]);
        }
        return back()->with([
            'message' => 'User update failed',
            "success" => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id);
        if ($user->delete())
        {
            return to_route('users.index')->with([
                'message' => 'User deleted successfully',
                "success" => true
            ]);
        }
        return back()->with([
            'message' => 'User deletion failed',
            "success" => false
        ]);
    }
}
