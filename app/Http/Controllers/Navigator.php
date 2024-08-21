<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Research;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Navigator extends Controller
{
    //
    function editBlog($id)
    {
      return view('pages.editBlog',['blog'=>Blog::findOrFail($id)]);
    }
    function newBlog()
    {
       return view('pages.newBlog');
    }
    function blogs()
    {
     return view('pages.blog');
    }
    function downloads()
    {
      return view('pages.downloads');
    }
    function gallery()
    {
       return view('pages.gallery');
    }
    function editResearch($id)
    {
      return view('Research.editResearch', ['research' => Research::find($id)]);
    }
    function newProject()
    {
       return view('Research.newProject');
    }
    function researchCategories()
    {
     return view('Research.category');
    }
    function research()
    {
      return view('Research.index');
    }
    function procurementList()
    {
      return view('Procurement.index');
    }
    function receipts()
    {
      return view('Finance.receipts');
    }
    function income()
    {
        return view('Finance.income');

    }
    function listExpenditures()
    {
      return view('Finance.expenditures');
    }
    function listInventoryCategory()
    {
      return view('inventory.category');
    }
    function listLivestock()
    {
      return view('Livestock.index');
    }
    function livestockBreeds()
    {
       return view('Livestock.breed');
    }
    function livestockCategories()
    {
        return view('Livestock.category');
    }
    function livestockTypes()
    {
      return view('Livestock.types');
    }
    function farmPlans()
    {
     return view('FarmPlans.index');
    }
    function cropList()
    {
      return view('Crops.index');
    }
    function cropCategories()
    {
     return view('Crops.category');
    }
    function users()
    {
     return view('Users.users');
    }
    function team()
    {
       return view('Users.team');
    }
    function departments()
    {
      return view('Users.departments');
    }
    function settings()
    {
      return view('Admin.settings');
    }
    function logout()
    {
     auth()->logout();
     return redirect('/login');
    }
    function admin()
    {
        return view('Admin.backend');
    }
    function resetPassword($token)
    {
      return view('Admin.reset_password',['token'=>$token]);
    }
    function index(){
        return view('Front.home');
    }
    function about()
    {
      return view('Front.about');
    }
    function login()
    {
      return view('Admin.login');
    }
    function register(){
        return view('Admin.register');
    }
    function forgetPassword()
    {
        return view('Admin.request_password');
    }

    function uoms()
    {
        return view("units.index");
    }

    function inventoryList()
    {
        return view("inventory.index");
    }

    function uploadTaskFile(Request $request): ?JsonResponse
    {
        $files=$request->allFiles();
        if (empty($files)){
            abort(422,"No files selected");
        }

        $requestKey = array_key_first($files);
        $file = is_array($request->input($requestKey))
            ? $request->file($requestKey)[0]
            : $request->file($requestKey);

        $path=$file->store("uploads",'public');

        return response()->json(["path"=>$path]);

    }

    function removeTaskFile(Request $request)
    {
        Log::error(json_encode($request->all()));
    }
}
