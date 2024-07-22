<?php

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

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginStore')->name('login.store');
});
Route::middleware(['auth', 'permission'])->group(function (){
    // Example Routes
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        "crops" => \App\Http\Controllers\CropsController::class,
        "farm-plans" => \App\Http\Controllers\FarmPlansController::class,
        "finances" => \App\Http\Controllers\FinanceController::class,
        "livestocks" => \App\Http\Controllers\LivestockController::class,
        "procurements" => \App\Http\Controllers\ProcurementController::class,
        "research" => \App\Http\Controllers\ResearchController::class,
        "users" => \App\Http\Controllers\UserController::class,
        "permissions" => \App\Http\Controllers\PermissionsController::class,
        "roles" => \App\Http\Controllers\RolesController::class,
    ]);
});


