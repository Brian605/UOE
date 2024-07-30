<?php

namespace App\Http\Controllers;

use App\Models\Crops;
use Illuminate\Http\Request;

class CropsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crops.index', [
            'crops' => Crops::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $crops = Crops::query()->create([
            'name' => $request->name,
            'type' => $request->type,
            'planting_date' => $request->planting_date,
            'harvest_date' => $request->harvest_date,
            'quantity' => $request->quantity,
        ]);
        if ($crops)
        {
            return to_route('crops.index')->with([
                "message" => "Crops successfully created",
                "success" => true
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "success" => false
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Crops $crops)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crops = Crops::query()->findOrFail($id);
        if ($crops)
        {
            $updated = $crops->update([
                'name' => $request->name,
                'type' => $request->type,
                'planting_date' => $request->planting_date,
                'harvest_date' => $request->harvest_date,
                'quantity' => $request->quantity,
            ]);
            if ($updated)
            {
                return to_route('crops.index')->with([
                   "message" => "Crops updated successfully",
                   "success" => false
                ]);
            }
            return back()->with([
                "message" => "Crops not updated successfully",
                "success" => false
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
            return to_route('crops.index')->with([
                "message" => "Deleted successfully",
                "success" => true
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "success" => false
        ]);
    }
}
