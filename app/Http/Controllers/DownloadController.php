<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //
    function deleteDownloads($id)
    {
      Download::destroy($id);
      return redirect()->back();
    }
    function addToDownload(Request $request)
    {
       Download::create([
           'name' => $request->name,
           'file'=>$request->file('image')->store('downloads','public')
       ]);
       return redirect()->back();
    }
}
