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
            return to_route('farm-plans.index')->with([
                "message" => "Farm plans added successfully",
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
    public function show(FarmPlans $farmPlans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farmPlan = FarmPlans::query()->findOrFail($id);
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
                return to_route('farm-plans.index')->with([
                   "message" => "Updated successfully",
                   "success" => true
                ]);
            }
            return back()->with([
               "message" => "An error occurred",
               "success" => false
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
                return to_route('farm-plans.index')->with([
                    "message" => "Farm plan deleted successfully",
                    "success" => true
                ]);
            }
            return back()->with([
               "message" => "An error occurred",
               "success" => false
            ]);
        }
        return back()->with([
            "message" => "An error occurred",
            "success" => false
        ]);
    }
}
