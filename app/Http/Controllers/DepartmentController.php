<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //
    function deleteDepartment($id)
    {
     Department::destroy($id);
     return back();
    }
    function storeDepartment(Request $request)
    {
      Department::create($request->only('name','icon'));
      return back();
    }
    function editDepartment(Request $request)
    {
        Department::find($request->dptId)->update($request->only('name','icon'));
        return back();
    }
}
