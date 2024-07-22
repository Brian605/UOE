<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use Illuminate\Http\Request;

class LivestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Livestock.index', [
            "livestocks" => Livestock::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $livestock = Livestock::query()->create([
            'type' => $request->type,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'weight' => $request->weight,
            'health_status' => $request->health_status,
        ]);
        if ($livestock) {
            return to_route('livestocks.index')->with([
                "message" => "Livestock created successfully",
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
    public function show(Livestock $livestock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livestock = Livestock::query()->findOrFail($id);
        if ($livestock) {
            $updated = $livestock->update([
                'type' => $request->type,
                'breed' => $request->breed,
                'birth_date' => $request->birth_date,
                'weight' => $request->weight,
                'health_status' => $request->health_status,
            ]);
            if ($updated) {
                return to_route('livestocks.index')->with([
                    "message" => "Livestock created successfully",
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
                return to_route('livestocks.index')->with([
                   "message" => "Livestock deleted successfully",
                    "success" => true
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "success" => false
            ]);
        }
        return back()->with([
            "message" => "An error occurred. Please try again",
            "success" => false
        ]);
    }
}
