<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Research.index', [
            "researches" => Research::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $start=Carbon::createFromFormat('Y-m-d', $request->start_date);
        $end=Carbon::createFromFormat('Y-m-d', $request->end_date);
        $duration=$start->diffInMonths($end);
        $research = Research::query()->create([
            'title'=>$request->title,
            'description'=>$request->description,
            'banner'=>$request->file('banner')->store('research', 'public'),
            'published'=>true,
            'sponsors'=>explode(',',$request->sponsors),
            'duration'=>$duration.' Months',
            'start_date'=>$start,
            'end_date'=>$end,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'cost'=>$request->cost,
        ]);
        if ($research) {
            return redirect('/research')->with([
                "message" => "Research created successfully",
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
    public function show(Research $research)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $research = Research::findOrFail($id);
        $start=Carbon::createFromFormat('Y-m-d', $request->start_date);
        $end=Carbon::createFromFormat('Y-m-d', $request->end_date);
        $duration=$start->diffInMonths($end);
        if ($research !=null) {
            $update = $research->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'published'=>true,
                'sponsors'=>explode(',',$request->sponsors),
                'duration'=>$duration.' Months',
                'start_date'=>$start,
                'end_date'=>$end,
                'status'=>$request->status,
                'category_id'=>$request->category_id,
                'cost'=>$request->cost,
            ]);
            if ($request->banner != null) {
                Research::query()->findOrFail($id)->update([
                    'banner'=>$request->file('banner')->store('research', 'public'),
                ]);
            }
            if ($update) {
                return redirect('/research')->with([
                    "message" => "Research updated successfully",
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
        $research = Research::query()->findOrFail($id);
        if ($research) {
            if ($research->delete()) {
                return redirect('/research')->with([
                    "message" => "Research deleted successfully",
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
