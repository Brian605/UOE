<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LivestockController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $livestock = Livestock::query()->create([
            'type' => $request->type,
            'breed' => $request->breed,
            'category'=> $request->category,
            'birth_date' => Carbon::createFromFormat('Y-m-d',$request->birth_date),
            'weight' => $request->weight,
            'health_status' => $request->health_status,
            'milk_produce' => $request->milk_produce
        ]);
        if ($livestock) {
            return back()->with([
                "message" => "Livestock created successfully",
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
        $livestock = Livestock::query()->findOrFail($request->livestockId);
        if ($livestock) {
            $updated = $livestock->update([
                'type' => $request->type,
                'category' => $request->category,
                'breed' => $request->breed,
                'birth_date' => $request->birth_date,
                'weight' => $request->weight,
                'health_status' => $request->health_status,
                'milk_produce' => $request->edit_milk_produce
            ]);
            if ($updated) {
                return redirect('/livestock/list')->with([
                    "message" => "Livestock updated successfully",
                    "type" => 'success'
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "type" => 'error'
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "type" => 'error'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $livestock = Livestock::query()->findOrFail($id);
        if ($livestock)
        {
            if ($livestock->delete())
            {
                return back()->with([
                   "message" => "Livestock deleted successfully",
                    "success" => true
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "type" => 'success'
            ]);
        }
        return back()->with([
            "message" => "An error occurred. Please try again",
            "type" => 'error'
        ]);
    }
}
