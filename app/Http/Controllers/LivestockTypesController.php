<?php

namespace App\Http\Controllers;

use App\Models\LivestockTypes;
use Illuminate\Http\Request;

class LivestockTypesController extends Controller
{
    //
    function store(Request $request)
    {
     LivestockTypes::create([
         'name' => $request->name,
         'icon' => $request->icon,
     ]) ;
     return redirect()->back();
    }

    function destroy($id)
    {
        LivestockTypes::destroy($id);
        return redirect()->back();
    }

    function update(Request $request)
    {
        LivestockTypes::find($request->dptId)->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        return redirect()->back();
    }
}
