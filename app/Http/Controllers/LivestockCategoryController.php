<?php

namespace App\Http\Controllers;

use App\Models\LivestockBreed;
use App\Models\LivestockCategory;
use App\Models\LivestockTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LivestockCategoryController extends Controller
{
    //
    function store(Request $request)
    {
        LivestockCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]) ;
        return redirect()->back();
    }

    function destroy($id)
    {
        LivestockCategory::destroy($id);
        return redirect()->back();
    }

    function update(Request $request)
    {
        LivestockCategory::find($request->dptId)->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        return redirect()->back();
    }

    function getCategories()
    {
        Log::info("Gttnnhgg");
      return LivestockCategory::all()->toArray();
    }
    function getBreeds()
    {
       return LivestockBreed::all()->toArray();
    }
}
