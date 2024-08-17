<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//employee
Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
    Route::put('/{id}', 'update')->name('update');
    Route::get('/', 'index')->name('index');/*->middleware('ability:sale.index');*/
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');/*->middleware('ability:sale.store');*/
    Route::delete('/{id}', 'delete')->name('delete');/*->middleware('ability:sale.cancel');*/
});
