<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Navigator extends Controller
{
    //
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
}
