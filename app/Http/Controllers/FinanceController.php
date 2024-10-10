<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\FinanceRecord;
use App\Models\Income;
use App\Models\ItemCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    function getExpenseByCategory()
    {
        $groupedExpenses = FinanceRecord::
        select('category_id',DB::raw('SUM(cost) as total_amount'))
            ->groupBy('category_id')
            ->orderBy('cost', 'desc')
            ->get();
        $rs=[];
        foreach ($groupedExpenses as $expense) {
            $category=ItemCategory::find($expense->category_id)->name;
            $rs[] = [$category, $expense->total_amount];
        }
        return $rs;
    }
    function getExpenseVsIncome()
    {
        $incomes=Income::whereMonth('date',Carbon::now()->month)->whereYear('date',Carbon::now()->year)->get(['date','amount'])->toArray();
        $expenses=FinanceRecord::whereMonth('date',Carbon::now()->month)->whereYear('date',Carbon::now()->year)->get(['date','cost'])->toArray();
return [
    'incomes'=>$incomes,
    'expenses'=>$expenses
];
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
