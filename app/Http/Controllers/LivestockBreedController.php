<?php

namespace App\Http\Controllers;

use App\Models\LivestockBreed;
use App\Models\LivestockCategory;
use Illuminate\Http\Request;

class LivestockBreedController extends Controller
{
    //
    function store(Request $request)
    {
        LivestockBreed::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'category_id' => $request->category_id,
        ]) ;
        return redirect()->back();
    }

    function destroy($id)
    {
        LivestockBreed::destroy($id);
        return redirect()->back();
    }

    function update(Request $request)
    {
        LivestockBreed::find($request->dptId)->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'category_id' => $request->category_id,
        ]);
        return redirect()->back();
    }
}
