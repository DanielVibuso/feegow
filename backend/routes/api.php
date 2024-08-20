<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLotController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\VaccineController;
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

//free routes/guest routes
Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/forgot-password', 'forgotPassword')->name('forgot.password');
    Route::post('/update-password', 'updatePassword')->name('update.password');
});

//employee
Route::/*middleware('auth:sanctum')->*/prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
    Route::put('/{id}', 'update')->name('update');
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'delete')->name('delete');
});

//employee lot controller
Route::/*middleware('auth:sanctum')->*/prefix('employee-lot')->name('employee-lot.')->controller(EmployeeLotController::class)->group(function () {
    Route::post('employee/{employee}/lot/{lot}', 'attach')->name('attach');
    Route::delete('employee/{employee}/lot/{lot}', 'detach')->name('detach');
    Route::put('{employee_lot_id}/lot-update/', 'update')->name('update');
    Route::get('/{employee}/lot', 'index')->name('index');
});

//vaccine
Route::/*middleware('auth:sanctum')->*/prefix('vaccine')->name('vaccine.')->controller(VaccineController::class)->group(function () {
    Route::put('/{id}', 'update')->name('update');
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'delete')->name('delete');
});

//lots
Route::/*middleware('auth:sanctum')->*/prefix('lot')->name('lot.')->controller(LotController::class)->group(function () {
    Route::put('/{id}', 'update')->name('update');
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'delete')->name('delete');
});
