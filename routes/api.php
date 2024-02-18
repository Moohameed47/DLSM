<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\shipping_companyController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\fac_ex_im_companyController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\requestController;
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

//Get All Data From DB
Route::get('admins', [adminController::class, 'index']);
Route::get('clients', [clientController::class, 'index']);
Route::get('agents', [agentController::class, 'index']);
Route::get('shipping_companies', [shipping_companyController::class, 'index']);
Route::get('fac_ex_im_companies',[fac_ex_im_companyController::class,'index']);
Route::get('offers', [offerController::class, 'index']);
Route::get('requests', [requestController::class, 'index']);

//Login & Register
Route::post('register',[registerController::class,'register']);
Route::post('login',[loginController::class,'login']);

//Requests
Route::get('requests/{id}', [requestController::class, 'show']);

//Agents
Route::get('agents/{id}', [agentController::class, 'show']);
Route::get('agents/destroy/{id}', [agentController::class, 'delete']);
Route::post('agents-create', [agentController::class, 'store']);

