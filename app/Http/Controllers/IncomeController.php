<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    //
    function storeIncome(Request $request)
    {
        Income::create([
            'source'=>$request->source,
            'date'=>Carbon::createFromFormat('Y-m-d',$request->date),
            'amount'=>$request->amount,
            'received_by'=>auth()->user()->id,
        ]);
        return redirect()->back();
    }
    function updateIncome(Request $request)
    {
       $income = Income::find($request->id);
       if ($request->source!=null){
           $income->source = $request->source;
       }
       if ($request->date!=null){
           $income->date = Carbon::createFromFormat('Y-m-d',$request->date);
       }
       if ($request->amount!=null){
           $income->amount = $request->amount;
       }
       $income->save();
       return redirect()->back();
    }

    function deleteIncome($id){
        Income::find($id)->delete();
        return redirect()->back();
    }
}
