<?php

namespace App\Http\Controllers;

use App\Models\FinanceRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceRecordController extends Controller
{
    //
    function destroy($id)
    {
       FinanceRecord::destroy($id);
       return back();
    }
    function update(Request $request)
    {
    $financeRecord = FinanceRecord::find($request->id);
    if ($request->date != null) {
        $financeRecord->date = Carbon::createFromFormat('Y-m-d', $request->date);
    }
    if ($request->category != null) {
        $financeRecord->category_id=$request->category;
    }
    if ($request->cost != null) {
     $financeRecord->cost=$request->cost;
    }
    if ($request->reason != null) {
      $financeRecord->description=$request->reason;
    }
    if ($request->item != null) {
        $financeRecord->item=$request->item;
    }
    $financeRecord->save();
    return redirect()->back();
    }
    function addExpense(Request $request)
    {
       FinanceRecord::create([
           'type' => 'expense',
           'date'=>Carbon::createFromFormat('Y-m-d', $request->date),
           'category_id'=>$request->category,
           'item'=>$request->item,
           'description'=>$request->reason,
           'cost'=>$request->cost,
       ]);
       return redirect()->back();
    }
    function addIncome(Request $request)
    {
        FinanceRecord::create([
            'type' => 'income',
            'date'=>Carbon::createFromFormat('Y-m-d', $request->date),
            'category_id'=>$request->category,
            'item'=>$request->item,
            'description'=>$request->reason,
            'cost'=>$request->cost,
        ]);
        return redirect()->back();
    }
}
