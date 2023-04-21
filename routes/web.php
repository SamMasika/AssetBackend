<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Office\OfficeController;
use App\Http\Controllers\Api\Asset\AssetController;
use App\Http\Controllers\Asset\DashboardController;
use App\Http\Controllers\Request\RequestController;
use App\Http\Controllers\Role\PermissionController;
use App\Http\Controllers\Section\SectionController;

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
    return view('auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);

    //Roles
    Route::get('/role-list', [RoleController::class, 'index']);
    Route::get('/role-create', [RoleController::class, 'create']);
    Route::post('/role-store', [RoleController::class, 'store']);
    Route::get('/role-edit/{id}', [RoleController::class, 'edit']);
    Route::post('/role-update/{id}', [RoleController::class, 'update']);
    Route::delete('/role-delete/{id}', [RoleController::class, 'destroy'])->name('delete.role');

     //Permissions
     Route::get('/permission-list', [PermissionController::class, 'index']);
     Route::get('/permission-create', [PermissionController::class, 'create']);
     Route::post('/permission-store', [PermissionController::class, 'store']);
     Route::get('/permission-edit/{id}', [PermissionController::class, 'edit']);
     Route::post('/permission-update/{id}', [PermissionController::class, 'update']);
     Route::delete('/permission-delete/{id}', [PermissionController::class, 'destroy'])->name('delete.permission');

     //Assets
     Route::get('/asset-list', [AssetController::class, 'index']);
     Route::get('/asset-create', [AssetController::class, 'create']);
     Route::post('/asset-store', [AssetController::class, 'store']);
     Route::get('/asset-show/{id}', [AssetController::class, 'show']);
     Route::post('/asset-update/{id}', [AssetController::class, 'update']);
     Route::delete('/asset-delete/{id}', [AssetController::class, 'destroy'])->name('delete.asset');
     Route::get('/electronics', [AssetController::class, 'electronics']);
     Route::get('/buildings', [AssetController::class, 'buildings']);
     Route::get('/furniture', [AssetController::class, 'furniture']);
     Route::get('/transport', [AssetController::class, 'transport']);
    
     Route::get('/assign-view/{id}',[AssetController::class,'assignView']);
     Route::post('/assignAsset/{id}',[AssetController::class,'assignAsset']);
     Route::get('/unassign-view/{id}',[AssetController::class,'unassignView']);
     Route::post('/assetUnassign/{id}',[AssetController::class,'assetUnassign']);
     Route::get('/workshop', [AssetController::class, 'workshop']);
     Route::post('/repair/{id}', [AssetController::class, 'repair']);
     Route::get('/disposal', [AssetController::class, 'disposal']);
     Route::post('/disposal-delete/{id}', [AssetController::class, 'destroyDisposal']);
     Route::get('generate-pdf', [AssetController::class, 'generatePDF']);

     //Request
     Route::get('/requests', [RequestController::class, 'index']);
     Route::post('/reject-request/{id}', [RequestController::class, 'reject']);
     Route::post('/approve-request/{id}', [RequestController::class, 'approve']);
     Route::post('/unavailable', [RequestController::class, 'unavailable']);
     Route::delete('/request-delete/{id}', [RequestController::class, 'destroy'])->name('delete.req');

     //Section
     Route::get('/section-list', [SectionController::class, 'index']);
     Route::post('/section-store', [SectionController::class, 'store']);
     Route::get('/section-show/{id}', [SectionController::class, 'show']);
     Route::post('/section-update/{id}', [SectionController::class, 'update']);
     Route::delete('/section-delete/{id}', [SectionController::class, 'destroy']);

     //Office
     Route::get('/office-list', [OfficeController::class, 'index']);
     Route::post('/office-store', [OfficeController::class, 'store']);
     Route::get('/office-show/{id}', [OfficeController::class, 'show']);
     Route::post('/office-update/{id}', [OfficeController::class, 'update']);
     Route::delete('/office-delete/{id}', [OfficeController::class, 'destroy']);

     //User
     Route::get('/user-list/{id?}', [UserController::class, 'index']);
     Route::post('/user-store', [UserController::class, 'store']);
     Route::get('/user-assignView/{id}', [UserController::class, 'assignView']);
     Route::post('/user-assignRole/{id}', [UserController::class, 'assignRole']);
     Route::get('/user-edit/{id}', [UserController::class, 'edit']);
     Route::post('/user-update/{id}', [UserController::class, 'update']);
     Route::put('/activate/{id}', [UserController::class, 'activate'])->name('activate.user');
     Route::put('/user-delete/{id}', [UserController::class, 'destroy'])->name('delete.user');
     Route::get('/change-password', [UserController::class, 'changePassword'])->name('change-password');
     Route::post('/change-password', [UserController::class, 'updatePassword'])->name('update-password');

    //  Orders
    Route::get('/order-list', [OrderController::class, 'index']);
    Route::post('/placeorder/{id}', [OrderController::class, 'placeorder'])->name('placeorder');
    Route::post('/reject/{id}', [OrderController::class, 'reject']);
    Route::post('/approve/{id}', [OrderController::class, 'approve']);
    Route::put('/order-delete/{id}', [OrderController::class, 'destroy'])->name('delete.order');
}); 
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
