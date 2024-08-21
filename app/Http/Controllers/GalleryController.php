<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    function deleteGallery($id)
    {
     Gallery::destroy($id);
     return redirect()->back();
    }
    function addToGallery(Request $request)
    {
        foreach ($request->gallery as $image) {
           Gallery::create([
               'caption' => $request->name,
               'image' => $image->store('gallery', 'public'),
           ]);
       }
        return redirect()->back();
    }
}
