<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $datos = [
        'nombre' => 'Eliver Doe',
        'correo' => 'john@example.com',
        'edad' => 30,
    ];
    return response()->json($datos);
});


Route::get('/Owner', [OwnerController::class, 'get']);
Route::post('/Owner', [OwnerController::class, 'save'])->middleware(['auth:api']);
Route::get('/Driver', [DriverController::class, 'get']);
Route::post('/Driver', [DriverController::class, 'save'])->middleware(['auth:api']);
Route::get('/Brands', [VehicleController::class, 'getBrands']);
Route::get('/Cities', [VehicleController::class, 'getCities']);
Route::post('/Vehicle', [VehicleController::class, 'save'])->middleware(['auth:api']);
Route::get('/Vehicle', [VehicleController::class, 'get']);
Route::get('/Owner/{id}', [OwnerController::class, 'getOwner']);
Route::get('/Driver/{id}', [DriverController::class, 'getDriver']);
Route::post('/Account', [AccountController::class, 'login']);
