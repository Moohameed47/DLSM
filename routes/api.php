<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\profileController;
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

Route::get('admins', [adminController::class, 'index'])->name('admin');
Route::post('register',[registerController::class,'register']);
Route::post('login',[loginController::class,'login']);
Route::get('clients', [clientController::class, 'index'])->name('client');
Route::get('agents', [agentController::class, 'index'])->name('agent');
Route::get('agents/{id}', [agentController::class, 'show'])->name('agents.show');
Route::get('agents/destroy/{id}', [agentController::class, 'delete'])->name('agents.delete');
Route::post('agents-create', [agentController::class, 'store'])->name('agents.create');
Route::group(
    [   
        "middleware" => ["auth:sanctum"]
    ],function() {
        Route::get("profile",[profileController::class,"profile"]);
        Route::get("logout",[logoutController::class,"logout"]);
    }
);