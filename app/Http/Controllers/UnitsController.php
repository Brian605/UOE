<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('units.index', [
            'units' => Units::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $units = Units::query()->create([
            'name' => $request->name,
            'unit' => $request->unit,
        ]);
        if ($units)
        {
            return redirect()->back()->with([
                "message" => "Units successfully created",
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
    public function show(Units $units)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Units $units)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $units = Units::query()->findOrFail($id);
        if ($units)
        {
            $updated = $units->update([
                'name' => $request->name,
                'unit' => $request->unit,
            ]);
            if ($updated)
            {
                return redirect()->back()->with([
                    "message" => "Updated Successfully",
                    "success" => true
                ]);
            }
            return back() ->with([
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
        $units = Units::query()->findOrFail($id);
        if ($units)
        {
            if ($units->delete())
            {
                return redirect()->back()->with([
                    "message" => "Deleted Successfully",
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
