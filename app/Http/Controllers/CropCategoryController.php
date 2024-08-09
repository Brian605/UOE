<?php

namespace App\Http\Controllers;

use App\Models\CropCategory;
use Illuminate\Http\Request;

class CropCategoryController extends Controller
{
    //
    function editCategory(Request $request)
    {
      CropCategory::find($request->dptId)->update([
          'name' => $request->name,
          'icon' => $request->icon,
      ]) ;
      return redirect()->back();
    }
    function deleteCategory($id)
    {
        CropCategory::destroy($id);
        return redirect()->back();
    }
    function addCategory(Request $request)
    {
      CropCategory::create([
          'name' => $request->name,
          'icon' => $request->icon,
      ])  ;
      return redirect()->back();
    }
}
