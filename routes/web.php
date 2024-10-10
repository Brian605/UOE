<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CropCategoryController;
use App\Http\Controllers\CropsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FarmPlansController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinanceRecordController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\LivestockBreedController;
use App\Http\Controllers\LivestockCategoryController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\LivestockTypesController;
use App\Http\Controllers\Navigator;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ResearchCategoryController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\UnitsController;
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
Route::get('/dashboard',[Navigator::class,'admin'])->middleware('auth');
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
Route::get('/inventory/categories',[Navigator::class,'listInventoryCategory'])->middleware('auth');
Route::get('/finance/expenses',[Navigator::class,'listExpenditures'])->middleware('auth');
Route::get('/finance/income',[Navigator::class,'income'])->middleware('auth');
Route::get('/finance/receipts',[Navigator::class,'receipts'])->middleware('auth');
Route::get('/password/forget',[Navigator::class,'forgetPassword'])->middleware('guest');
Route::get('/password/reset/{token}',[Navigator::class,'resetPassword'])->middleware('guest');
Route::get("/inventory/uoms", [Navigator::class, "uoms"])->middleware("auth");
Route::get("/inventory/list", [Navigator::class, "inventoryList"])->middleware("auth");
Route::get("/procurement/list", [Navigator::class, "procurementList"])->middleware("auth");
Route::get("/research", [Navigator::class, "research"])->middleware("auth");
Route::get("/research/new", [Navigator::class, "newProject"])->middleware("auth");
Route::get("/research/categories", [Navigator::class, "researchCategories"])->middleware("auth");
Route::get("/research/edit/{id}", [Navigator::class, "editResearch"])->middleware("auth");
Route::get('/admin/gallery', [Navigator::class,'gallery']);
Route::get('/admin/downloads', [Navigator::class,'downloads']);
Route::get('/admin/blogs', [Navigator::class,'blogs']);
Route::get('/blogs/new', [Navigator::class,'newBlog']);
Route::get("/blogs/edit/{id}", [Navigator::class, "editBlog"])->middleware("auth");
Route::get("/reports", [Navigator::class, "reports"])->middleware("auth");
Route::get('/getExpenseByCategory',[FinanceController::class,'getExpenseByCategory']);

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
Route::get('/livestock/categories/fetchAll',[LivestockCategoryController::class,'getCategories'])->middleware('guest');

Route::post('/livestock/breed/new',[LivestockBreedController::class,'store'])->middleware('auth');
Route::post('/livestock/breed/edit',[LivestockBreedController::class,'update'])->middleware('auth');
Route::get('/livestock/breed/delete/{id}',[LivestockBreedController::class,'destroy'])->middleware('auth');

Route::post('/livestock/new',[LivestockController::class,'store'])->middleware('auth');
Route::post('/livestock/edit',[LivestockController::class,'update'])->middleware('auth')->name('livestock.edit');
Route::get('/livestock/delete/{id}',[LivestockController::class,'destroy'])->middleware('auth');

Route::post('/item/category/new',[ItemCategoryController::class,'store'])->middleware('auth');
Route::post('/item/category/edit',[ItemCategoryController::class,'update'])->middleware('auth');
Route::get('/item/category/delete/{id}',[ItemCategoryController::class,'destroy'])->middleware('auth');

Route::post('/expense/item/new',[FinanceRecordController::class,'addExpense'])->middleware('auth');
Route::post('/expense/item/edit',[FinanceRecordController::class,'update'])->middleware('auth');
Route::get('/expense/item/delete/{id}',[FinanceRecordController::class,'destroy'])->middleware('auth');

Route::post('/income/item/new',[IncomeController::class,'storeIncome'])->middleware('auth');
Route::post('/income/item/edit',[IncomeController::class,'updateIncome'])->middleware('auth');
Route::get('/income/item/delete/{id}',[IncomeController::class,'deleteIncome'])->middleware('auth');

Route::post('/receipt/item/new',[ReceiptController::class,'storeReceipt'])->middleware('auth');
Route::post('/receipt/item/edit',[ReceiptController::class,'updateReceipt'])->middleware('auth');
Route::get('/receipt/item/delete/{id}',[ReceiptController::class,'deleteReceipt'])->middleware('auth');

// Units
Route::post("/inventory/uoms/new", [UnitsController::class, "store"])->middleware("auth");
Route::put("/inventory/uoms/{id}", [UnitsController::class, "update"])->middleware("auth");
Route::delete("/inventory/uoms/delete/{id}", [UnitsController::class, "destroy"])->middleware("auth");

// Inventory
Route::post("/inventory/list/new", [InventoryController::class, "store"])->middleware("auth");
Route::put("/inventory/list/{id}", [InventoryController::class, "update"])->middleware("auth");
Route::delete("/inventory/list/delete/{id}", [InventoryController::class, "destroy"])->middleware
("auth");

Route::post("/procurement/new", [ProcurementController::class, "store"])->middleware("auth");
Route::put("/procurement/edit/{id}", [ProcurementController::class, "update"])->middleware("auth");
Route::delete("/procurement/delete/{id}", [ProcurementController::class, "destroy"])->middleware
("auth");

Route::post('/project/category/new',[ResearchCategoryController::class,'store'])->middleware('auth');
Route::post('/project/category/edit',[ResearchCategoryController::class,'update'])->middleware('auth');
Route::get('/project/category/delete/{id}',[ResearchCategoryController::class,'destroy'])->middleware('auth');

Route::post('/research/new',[ResearchController::class,'store'])->middleware('auth');
Route::post('/research/edit/{id}',[ResearchController::class,'update'])->middleware('auth');
Route::get('/research/delete/{id}',[ResearchController::class,'destroy'])->middleware('auth');

Route::post('/gallery/new', [GalleryController::class,'addToGallery'])->middleware('auth');;
Route::post('/downloads/new', [DownloadController::class,'addToDownload'])->middleware('auth');;

Route::post('/blogs/new', [BlogController::class,'storeBlog'])->middleware('auth');
Route::get('/blogs/delete/{edit}', [BlogController::class,'deleteBlog'])->middleware('auth');
Route::post("/blogs/edit/{id}", [BlogController::class, "editBlog"])->middleware("auth");


Route::get('/expenseAndIncome',[FinanceController::class,'getExpenseVsIncome']);




Route::post('/system/files/add',[Navigator::class,'uploadTaskFile']);
Route::delete('/system/files/delete',[Navigator::class,'removeTaskFile']);

