<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\countryController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\portController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\shipping_companyController;
use App\Http\Controllers\PostController;
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


//Admins
Route::get('admins', [adminController::class, 'index']);


//Agents
Route::get('agents/{id}', [agentController::class, 'show']);
Route::get('agents/destroy/{id}', [agentController::class, 'delete']);
Route::post('agents-create', [agentController::class, 'store']);
Route::get('agents', [agentController::class, 'index']);
Route::get('ShippingAgent/{id}', [agentController::class, 'ShippingAgent']);


//Shipping
Route::get('shipping_companies', [shipping_companyController::class, 'index']);
Route::get('shipping/agent/{id}', [shipping_companyController::class, 'shippingForSpecificAgent']);
Route::post('shipping-search', [shipping_companyController::class, 'search']);


//Client
Route::get('clients', [clientController::class, 'index_client']);
Route::get('All_Clients', [clientController::class, 'index']);
Route::get('ex_im_companies', [clientController::class, 'index_ex_im']);
Route::get('fac_companies', [clientController::class, 'index_fac']);


//Offers
Route::get('offers/{id}', [offerController::class, 'show']);
Route::post('offers-create', [offerController::class, 'store']);
Route::get('offers', [offerController::class, 'index']);
Route::get('offersNotAccept', [offerController::class, 'indexNotAccept']);
Route::get('offers/request/{id}', [offerController::class, 'offersForSpecificRequest']);
Route::get('offers/agent/{id}', [offerController::class, 'offerForSpecificAgent']);
Route::get('offer-accept/{request_id}/{offer_id}', [offerController::class, 'AcceptOffers']);
Route::get('getAgentAndShippingData/{id}', [offerController::class, 'getAgentAndShippingData']);
Route::get('Which-offer-accept', [offerController::class, 'WhichOfferAccept']);

//Requests
Route::get('requests/{id}', [requestController::class, 'show']);
Route::post('requests-create', [requestController::class, 'store']);
Route::get('requests', [requestController::class, 'index']);


//Profile
Route::post('myData', [profileController::class, 'index']);
Route::post('myData-edit/{id}/{TypeOfClient}', [profileController::class, 'update']);


//Country
Route::get('Countries', [countryController::class, 'index']);


//Ports
Route::get('ports', [portController::class, 'index']);
Route::post('port-create', [portController::class, 'store']);
Route::get('port-show/{id}', [portController::class, 'show']);


//Login & Register
Route::post('register', [registerController::class, 'register']);
Route::post('login', [loginController::class, 'login']);


//process
Route::get('current_Process/{id}', [requestController::class, 'current_Process']);
Route::get('updateBooking/{id}', [requestController::class, 'updateBooking']);
Route::get('updateLoading/{id}', [requestController::class, 'updateLoading']);
Route::get('updateTrucking/{id}', [requestController::class, 'updateTrucking']);
Route::get('updateCustom_clearance/{id}', [requestController::class, 'updateCustom_clearance']);
Route::get('updateDone/{id}', [requestController::class, 'updateDone']);
Route::get('updateOn_trip/{id}', [requestController::class, 'updateOn_trip']);

//posts
Route::get('posts',[PostController::class,'index']);
Route::get('posts/{id}',[PostController::class,'show']);
Route::post('posts-update/{id}',[PostController::class,'update']);
Route::get('posts-destroy/{id}',[PostController::class,'update']);
Route::post('posts-create',[PostController::class,'store']);

//Feedback
Route::get('feedback', [feedbackController::class, 'index']);
Route::get('feedback/{id}', [feedbackController::class, 'show']);
Route::post('feedback-create', [feedbackController::class, 'store']);
Route::post('feedback-update/{id}', [feedbackController::class, 'update']);
Route::get('feedback-destroy/{id}', [feedbackController::class, 'destroy']);

Route::get('feedback/avg-rate', [FeedbackController::class, 'getAverageRatings']);
