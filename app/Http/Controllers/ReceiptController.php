<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    //
    function storeReceipt(Request $request)
    {
        if (Receipt::where('ref_number',$request->ref_number)->exists()) {
            return back()->with([
                'type' => 'error',
                'message'=>'A receipt for the same number already exists',
                'title' => 'Error',
            ]);
        }
        Receipt::create([
            'ref_number' => $request->ref_number,
            'amount' => $request->amount,
            'date' => Carbon::createFromFormat('Y-m-d', $request->date),
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    function updateReceipt(Request $request)
    {
       $receipt = Receipt::find($request->id);
       if ($request->ref_number!=null){
           $receipt->ref_number = $request->ref_number;
       }
       if ($request->amount!=null){
           $receipt->amount = $request->amount;
       }
       if ($request->date!=null){
           $receipt->date=Carbon::createFromFormat('Y-m-d', $request->date);
       }
       if ($request->description!=null){
           $receipt->description = $request->description;
       }
       $receipt->save();
       return back();
    }
    function deleteReceipt($id){
      Receipt::find($id)->delete();
      return back();
    }
}
