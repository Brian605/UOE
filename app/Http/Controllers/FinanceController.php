<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Finance.index', [
            "finances" => Finance::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $finance = Finance::query()->create([
            'item' => $request->item,
            'cost' => $request->cost,
            'date' => $request->date,
            'category' => $request->category,
        ]);
        if ($finance)
        {
            return to_route('finances.index')->with([
                "message" => "Finances created successfully",
                "success" => true
            ]);
        }
        return to_route('finances.index')->with([
            "message" => "An error occurred",
            "success" => false
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $finance = Finance::query()->findOrFail($id);
        if ($finance)
        {
            $updated = $finance->update([
                'item' => $request->item,
                'cost' => $request->cost,
                'date' => $request->date,
                'category' => $request->category,
            ]);
            if ($updated)
            {
                return to_route('finances.index')->with([
                   "message" => "Updated Successfully",
                   "success" => true
                ]);
            }
            return back() ->with([
                "message" => "An error occurred",
                "success" => true
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
        $finance = Finance::query()->findOrFail($id);
        if ($finance)
        {
            if ($finance->delete())
            {
                return to_route('finances.index')->with([
                    "message" => "Finance deleted successfully",
                    "success" => true
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "success" => false
            ]);
        }
        return back()->with([
            'message' => "An error occurred",
            "success" => false
        ]);
    }
}
