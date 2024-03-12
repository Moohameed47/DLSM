<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\shipping_companyController;
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
Route::get('clients', [clientController::class, 'index_client']);
Route::get('All_Clients', [clientController::class, 'index']);
Route::get('agents', [agentController::class, 'index']);
Route::get('shipping_companies', [shipping_companyController::class, 'index']);
Route::get('ex_im_companies', [ clientController::class, 'index_ex_im']);
Route::get('fac_companies', [clientController::class, 'index_fac']);
Route::get('offers', [offerController::class, 'index']);
Route::get('requests', [requestController::class, 'index']);
Route::post('myData', [profileController::class, 'index']);
Route::get('ShippingAgent/{id}', [agentController::class, 'ShippingAgent']);

//Login & Register
Route::post('register', [registerController::class, 'register']);
Route::post('login', [loginController::class, 'login']);

//Requests
Route::get('requests/{id}', [requestController::class, 'show']);
Route::post('requests-create', [requestController::class, 'store']);

//Offers
Route::get('offers/{id}', [offerController::class, 'show']);
Route::post('offers-create', [offerController::class, 'store']);

//Agents
Route::get('agents/{id}', [agentController::class, 'show']);
Route::get('agents/destroy/{id}', [agentController::class, 'delete']);
Route::post('agents-create', [agentController::class, 'store']);

// Retrieve all First for a specific Second
Route::get('offers/agent/{id}',[offerController::class, 'offerForSpecificAgent']);
Route::get('shipping/agent/{id}',[shipping_companyController::class, 'shippingForSpecificAgent']);
Route::get('offers/request/{id}',[offerController::class, 'offersForSpecificRequest']);






