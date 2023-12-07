<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\clientController;
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
Route::get('clients', [clientController::class, 'index'])->name('client');
Route::get('agents', [agentController::class, 'index'])->name('agent');
