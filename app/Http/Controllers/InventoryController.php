<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('inventory.index', [
            'inventories' => Inventory::all(),
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
        $inventory = Inventory::query()->create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_id' => $request->unit_id,
            'approved_by' => Auth::user()->name,
        ]);
        if ($inventory)
        {
            return to_route('inventory.index')->with([
                "message" => "Inventory successfully created",
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
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inventory = Inventory::query()->findOrFail($id);
        if ($inventory)
        {
            if ($request->type === 'increase')
            {
                $inventory->update([
                    'quantity' => $inventory->quantity + $request->quantity,
                    'approved_by' => Auth::user()->name,
                ]);
                return to_route('inventory.index')->with([
                    "message" => "Inventory updated successfully",
                    "success" => true
                ]);

            }
            if ($request->type === 'decrease')
            {
                if ($inventory->quantity < $request->quantity)
                {
                    return back()->with([
                        "message" => "Quantity to reduce is more than available quantity",
                        "success" => false
                    ]);
                }
                $inventory->update([
                    'quantity' => $inventory->quantity - $request->quantity,
                    'approved_by' => Auth::user()->name,
                ]);
                return to_route('inventory.index')->with([
                    "message" => "Inventory updated successfully",
                    "success" => true
                ]);
            }

            $updated = $inventory->update([
                'item' => $request->item,
                'quantity' => $request->quantity,
                'unit_id' => $request->unit_id,
                'approved_by' => Auth::user()->name,
            ]);
            if ($updated)
            {
                return to_route('inventory.index')->with([
                    "message" => "Inventory updated successfully",
                    "success" => true
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "success" => false
            ]);
        }
        return back()->with([
            "message" => "Inventory not found",
            "success" => false
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::query()->findOrFail($id);
        if ($inventory)
        {
            $deleted = $inventory->delete();
            if ($deleted)
            {
                return to_route('inventory.index')->with([
                    "message" => "Inventory deleted successfully",
                    "success" => true
                ]);
            }
            return back()->with([
                "message" => "An error occurred",
                "success" => false
            ]);
        }
        return back()->with([
            "message" => "Inventory not found",
            "success" => false
        ]);
    }
}
