<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\LivestockCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    //
    function store(Request $request)
    {
        ItemCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]) ;
        return redirect()->back();
    }

    function destroy($id)
    {
        ItemCategory::destroy($id);
        return redirect()->back();
    }

    function update(Request $request)
    {
        ItemCategory::find($request->dptId)->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        return redirect()->back();
    }
}
