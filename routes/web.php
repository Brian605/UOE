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

// Example Routes
Route::get('/', function () {
    return view('dashboard');
});
Route::resources([
    "crops" => \App\Http\Controllers\CropsController::class,
    "farm-plans" => \App\Http\Controllers\FarmPlansController::class,
    "finances" => \App\Http\Controllers\FinanceController::class,
    "livestocks" => \App\Http\Controllers\LivestockController::class,
    "procurements" => \App\Http\Controllers\ProcurementController::class,
    "research" => \App\Http\Controllers\ResearchController::class,
]);

Route::get('/datatable', function () {
    return view('pages.datatables');
});
