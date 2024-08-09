<?php

namespace App\Http\Controllers;

use App\Models\Crops;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CropsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $crops = Crops::query()->create([
            'name' => $request->name,
            'type' => $request->type,
            'planting_date' => Carbon::createFromFormat('Y-m-d',$request->planting_date),
            'harvest_date' => Carbon::createFromFormat('Y-m-d',$request->harvest_date),
            'quantity' => $request->quantity,
        ]);
        if ($crops)
        {
            return redirect('/crops/lists')->with([
                "message" => "Crops successfully created",
                "type" => 'success'
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "type" => 'error'
        ]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $crops = Crops::query()->findOrFail($request->cropId);
        if ($crops)
        {
            $updated = $crops->update([
                'name' => $request->name,
                'type' => $request->type,
                'planting_date' => Carbon::createFromFormat('Y-m-d',$request->planting_date),
                'harvest_date' => Carbon::createFromFormat('Y-m-d',$request->harvest_date),
                'quantity' => $request->quantity,
            ]);
            if ($updated)
            {
                return redirect('/crops/lists')->with([
                   "message" => "Crops updated successfully",
                   "type" => 'success'
                ]);
            }
            return back()->with([
                "message" => "Crops not updated",
                "type" => 'error'
            ]);
        }
        return back()->with([
            "message" => "Crops not found",
            "success" => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $crop = Crops::query()->findOrFail($id);
        if ($crop->delete())
        {
            return back()->with([
                "message" => "Deleted successfully",
                "type" => 'success'
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "type" => 'error'
        ]);
    }
}
