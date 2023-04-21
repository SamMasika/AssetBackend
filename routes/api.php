<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Asset\AssetController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Asset\NamingController;
use App\Http\Controllers\Api\Office\OfficeController;
use App\Http\Controllers\Api\Section\SectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post ('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::group([
    'middleware' => 'auth:api'
  ], function() {
      Route::get('logout', [AuthController::class,'logout']);
      Route::get('user', [AuthController::class,'user']);
      Route::Resource('/users',UserController::class);    

      //Office
     Route::get('/office-list', [OfficeController::class, 'index']);
     Route::post('/office-store', [OfficeController::class, 'store']);
     Route::get('/office-show/{id}', [OfficeController::class, 'show']);
     Route::post('/office-update/{id}', [OfficeController::class, 'update']);
     Route::delete('/office-delete/{id}', [OfficeController::class, 'destroy'])->name('delete.office');

     //Section
     Route::get('/section-list', [SectionController::class, 'index']);
     Route::post('/section-store', [SectionController::class, 'store']);
     Route::get('/section-show/{id}', [SectionController::class, 'show']);
     Route::post('/section-update/{id}', [SectionController::class, 'update']);
     Route::delete('/section-delete/{id}', [SectionController::class, 'destroy'])->name('delete.section');

     //Naming
     Route::get('/name-list', [NamingController::class, 'index']);
     Route::post('/name-store', [NamingController::class, 'store']);
     Route::get('/name-show/{id}', [NamingController::class, 'show']);
     Route::post('/name-update/{id}', [NamingController::class, 'update']);
     Route::delete('/name-delete/{id}', [NamingController::class, 'destroy'])->name('delete.name');

     //Asset
     Route::get('/asset-list', [AssetController::class, 'index']);
     Route::get('/asset-category', [AssetController::class, 'assetsByCategory']);
     Route::get('/status', [AssetController::class, 'status']);
     Route::get('/electronics', [AssetController::class, 'electronics']);
     Route::post('/electronic', [AssetController::class, 'electronic']);
     Route::get('/furniture', [AssetController::class, 'furniture']);
     Route::get('/buildings', [AssetController::class, 'buildings']);
     Route::get('/vehicles', [AssetController::class, 'vehicles']);
     Route::get('/faults', [AssetController::class, 'faults']);
     Route::get('/workshop', [AssetController::class, 'workshop']);
     Route::get('/disposal', [AssetController::class, 'disposal']);
     Route::post('/repair/{id}', [AssetController::class, 'repair']);
     Route::get('/assign-view/{id}',[AssetController::class,'assignView']);
     Route::get('/unassign-view/{id}',[AssetController::class,'unassignView']);
     Route::post('/asset-assign/{id}', [AssetController::class, 'assignAsset']);
     Route::post('/asset-unassign/{id}', [AssetController::class, 'assetUnassign']);
     Route::post('/asset-store', [AssetController::class, 'store']);
     Route::get('/asset-show/{id}', [AssetController::class, 'show']);
     Route::post('/asset-update/{id}', [AssetController::class, 'update']);
     Route::delete('/asset-delete/{id}', [AssetController::class, 'destroy']);
     Route::post('/placeorder/{id}', [AssetController::class, 'placeorder']);

     //Order
     Route::get('/order-list', [OrderController::class, 'index']);
     Route::post('/order-store', [OrderController::class, 'store']);
     Route::post('/order-approve/{id}', [OrderController::class, 'approve']);
     Route::post('/order-reject/{id}', [OrderController::class, 'reject']);
     Route::post('/order-update/{id}', [OrderController::class, 'update']);
     Route::delete('/order-delete/{id}', [OrderController::class, 'destroy']);

     //User
     Route::get('/user-list', [UserController::class, 'index']);
     Route::post('/user-store', [UserController::class, 'store']);
     Route::post('/user-activate/{id}', [UserController::class, 'activate']);
     Route::get('/user-show/{id}', [UserController::class, 'show']);
     Route::put('/user-update/{id}', [UserController::class, 'update']);
     Route::put('/user-delete/{id}', [UserController::class, 'destroy']);
    });
