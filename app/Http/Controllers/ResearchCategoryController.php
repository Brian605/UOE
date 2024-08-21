<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\ResearchCategory;
use Illuminate\Http\Request;

class ResearchCategoryController extends Controller
{
    //
    function store(Request $request)
    {
        ResearchCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]) ;
        return redirect()->back();
    }

    function destroy($id)
    {
        ResearchCategory::destroy($id);
        return redirect()->back();
    }

    function update(Request $request)
    {
        ResearchCategory::find($request->dptId)->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        return redirect()->back();
    }
}
