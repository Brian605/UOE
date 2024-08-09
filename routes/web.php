<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CropCategoryController;
use App\Http\Controllers\CropsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FarmPlansController;
use App\Http\Controllers\LivestockBreedController;
use App\Http\Controllers\LivestockCategoryController;
use App\Http\Controllers\LivestockTypesController;
use App\Http\Controllers\Navigator;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[Navigator::class,'index'])->withoutMiddleware(Authenticate::class);
Route::get('/home',[Navigator::class,'index'])->withoutMiddleware(Authenticate::class);
Route::get('/about',[Navigator::class,'about'])->middleware('guest');
Route::get('/admin',[Navigator::class,'admin'])->middleware('auth');
Route::get('/login',[Navigator::class,'login'])->middleware('guest');
Route::get('/register',[Navigator::class,'register'])->middleware('guest');
Route::get('/logout',[Navigator::class,'logout'])->middleware('auth');
Route::get('/settings',[Navigator::class,'settings'])->middleware('auth');
Route::get('/team',[Navigator::class,'team'])->middleware('auth');
Route::get('/departments',[Navigator::class,'departments'])->middleware('auth');
Route::get('/users',[Navigator::class,'users'])->middleware('auth');
Route::get('/crops/categories',[Navigator::class,'cropCategories'])->middleware('auth');
Route::get('/farm/plans',[Navigator::class,'farmPlans'])->middleware('auth');
Route::get('/crops/lists',[Navigator::class,'cropList'])->middleware('auth');
Route::get('/livestock/types',[Navigator::class,'livestockTypes'])->middleware('auth');
Route::get('/livestock/categories',[Navigator::class,'livestockCategories'])->middleware('auth');
Route::get('/livestock/breeds',[Navigator::class,'livestockBreeds'])->middleware('auth');
Route::get('/livestock/list',[Navigator::class,'listLivestock'])->middleware('auth');
Route::get('/password/forget',[Navigator::class,'forgetPassword'])->middleware('guest');
Route::get('/password/reset/{token}',[Navigator::class,'resetPassword'])->middleware('guest');

Route::post('/register',[AuthController::class,'register'])->middleware('guest');
Route::post('/password/request',[AuthController::class,'requestPassword'])->middleware('guest');
Route::post('/password/reset',[AuthController::class,'resetPassword'])->middleware('guest');
Route::post('/login',[AuthController::class,'loginUser'])->middleware('guest');
Route::post('/password/change',[AuthController::class,'changePassword'])->middleware('auth');
Route::post('/team/new',[AuthController::class,'newTeam'])->middleware('auth');
Route::post('/users/new',[AuthController::class,'newUser'])->middleware('auth');
Route::post('/users/edit',[AuthController::class,'editUser'])->middleware('auth');

Route::post('/department/new',[DepartmentController::class,'storeDepartment'])->middleware('auth');
Route::post('/department/edit',[DepartmentController::class,'editDepartment'])->middleware('auth');
Route::get('/department/delete/{id}',[DepartmentController::class,'deleteDepartment'])->middleware('auth');

Route::post('/crops/category/new',[CropCategoryController::class,'addCategory'])->middleware('auth');
Route::post('/crops/category/edit',[CropCategoryController::class,'editCategory'])->middleware('auth');
Route::get('/crops/category/delete/{id}',[CropCategoryController::class,'deleteCategory'])->middleware('auth');

Route::post('/crops/new',[CropsController::class,'store'])->middleware('auth');
Route::post('/crops/edit',[CropsController::class,'update'])->middleware('auth');
Route::get('/crops/delete/{id}',[CropsController::class,'destroy'])->middleware('auth');

Route::post('/farm/plans/new',[FarmPlansController::class,'store'])->middleware('auth');
Route::post('/farm/plans/edit',[FarmPlansController::class,'update'])->middleware('auth');
Route::get('/farm/plans/delete/{id}',[FarmPlansController::class,'destroy'])->middleware('auth');

Route::post('/livestock/types/new',[LivestockTypesController::class,'store'])->middleware('auth');
Route::post('/livestock/types/edit',[LivestockTypesController::class,'update'])->middleware('auth');
Route::get('/livestock/types/delete/{id}',[LivestockTypesController::class,'destroy'])->middleware('auth');

Route::post('/livestock/category/new',[LivestockCategoryController::class,'store'])->middleware('auth');
Route::post('/livestock/category/edit',[LivestockCategoryController::class,'update'])->middleware('auth');
Route::get('/livestock/category/delete/{id}',[LivestockCategoryController::class,'destroy'])->middleware('auth');

Route::post('/livestock/breed/new',[LivestockBreedController::class,'store'])->middleware('auth');
Route::post('/livestock/breed/edit',[LivestockBreedController::class,'update'])->middleware('auth');
Route::get('/livestock/breed/delete/{id}',[LivestockBreedController::class,'destroy'])->middleware('auth');
