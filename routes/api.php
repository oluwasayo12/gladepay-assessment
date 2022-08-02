<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix("auth")->name("auth.")->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name("login");
});



Route::middleware(['auth:sanctum', 'role:super-admin|employee|admin'])->prefix('v1')->group(function() {
    Route::get('view_company_details', [EmployeesController::class, 'show'])->name("view-company");
});



Route::middleware(['auth:sanctum', 'role:super-admin|company|admin'])->prefix('v1')->group(function() {
    Route::get('view_employee_details', [CompaniesController::class, 'show'])->name("view-employees");
});


Route::middleware(['auth:sanctum', 'role:super-admin|admin|company'])->prefix('v1')->group(function() {
    Route::post('create_employee', [EmployeesController::class, 'create'])->name("create-employee");
});

Route::middleware(['auth:sanctum', 'role:super-admin|admin'])->prefix('v1')->group(function() {
    Route::post('create_company', [CompaniesController::class, 'create'])->name("create-company");
});


Route::middleware(['auth:sanctum','role:super-admin'])->prefix('v1')->group(function() {
    // create admin
    Route::post('create_admin', [AdminController::class, 'createAdmin'])->name("createAdmin");
    Route::get('list_all_admin', [AdminController::class, 'listAllAdmin'])->name("listAllAdmin");
    Route::delete('delete_admin/{id}', [AdminController::class, 'deleteAdminAccount'])->name("deleteAdminAccount");

    //company
    Route::delete('delete_company/{id}', [CompaniesController::class, 'delete'])->name("delete-company");
    
    //employee
    Route::delete('delete_employee/{id}', [EmployeesController::class, 'delete'])->name("delete-employee");

    //activity log
    Route::get('list_all_activities', [ActivityLogController::class, 'show'])->name("show");

});










Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});

