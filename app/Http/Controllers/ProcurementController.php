<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Procurement.index', [
            "procurements" => Procurement::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $procurement = Procurement::query()->create([
            'item' => $request->item,
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'type' => $request->type,
            'date' => $request->date,
            'payment_mode' => $request->payment_mode,
            'transaction_id' => $request->transaction_id
        ]);
        if ($procurement)
        {
            return to_route('procurements.index')->with([
                "message" => "Procurements created Successfully",
                "success" => true
            ]);

        }
        return back()->with([
            "message" => "An error occurred",
            "success" =>false
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Procurement $procurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procurement $procurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $procurement = Procurement::query()->findOrFail($id);
        if ($procurement)
        {
            $updated = $procurement->update([
                'item' => $request->item,
                'quantity' => $request->quantity,
                'cost' => $request->cost,
                'type' => $request->type,
                'date' => $request->date,
                'payment_mode' => $request->payment_mode,
                'transaction_id' => $request->transaction_id
            ]);
            if ($updated)
            {
                return to_route('procurements.index')->with([
                    "message" => "Procurements updated successfully",
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
        $procurement = Procurement::query()->findOrFail($id);
        if ($procurement)
        {
            if ($procurement->delete())
            {
                return to_route('procurements.index')->with([
                   "message" => "Deleted successfully",
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
