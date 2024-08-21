<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    function editBlog(Request $request,$id)
    {
      Blog::find($id)->update([
          'title'=>$request->title,
          'cause'=>$request->category,
          'description'=>$request->description,
          'content'=>$request->blog,
          'tags'=>explode(',',$request->tags),
      ]);
      if ($request->filepond!=null) {
          Blog::find($id)->update([
              'banner'=>json_decode($request->filepond,true)['path'],
          ]);

      }
        return redirect('/admin/blogs');
    }
    function deleteBlog($id)
    {
        Blog::destroy($id);
        return redirect()->back();

    }
    function storeBlog(Request $request)
    {
       Blog::create([
           'title'=>$request->title,
           'cause'=>$request->category,
           'description'=>$request->description,
           'content'=>$request->blog,
           'banner'=>json_decode($request->filepond,true)['path'],
           'tags'=>explode(',',$request->tags),
           'user_id'=>auth()->user()->id,
           'views'=>0,
       ]) ;
       return redirect('/admin/blogs');
    }
}
