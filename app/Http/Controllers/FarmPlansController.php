<?php

namespace App\Http\Controllers;

use App\Models\FarmPlans;
use Illuminate\Http\Request;

class FarmPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('FarmPlans.index', [
            "farmPlans" => FarmPlans::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farmPlans = FarmPlans::query()->create([
            'objective' => $request->objective,
            'layout' => $request->layout,
            'infrastructure' => $request->infrastructure,
            'location' => $request->location,
            'farm_size' => $request->farm_size
        ]);
        if ($farmPlans)
        {
            return back()->with([
                "message" => "Farm plans added successfully",
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
        $farmPlan = FarmPlans::query()->findOrFail($request->id);
        if ($farmPlan)
        {
            $updated = $farmPlan->update([
                'objective' => $request->objective,
                'layout' => $request->layout,
                'infrastructure' => $request->infrastructure,
                'location' => $request->location,
                'farm_size' => $request->farm_size
            ]);
            if ($updated)
            {
                return back()->with([
                   "message" => "Updated successfully",
                   "type" => 'success'
                ]);
            }
            return back()->with([
               "message" => "An error occurred",
               "type" => 'error'
            ]);
        }
        return back()->with([
            "message" => "Farm Plan Not found",
            "success" => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $farmPlans = FarmPlans::query()->findOrFail($id);
        if ($farmPlans)
        {
            if ($farmPlans->delete())
            {
                return back()->with([
                    "message" => "Farm plan deleted successfully",
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
            "success" => false
        ]);
    }
}
