<?php

use App\Http\Controllers\Management\BranchAddressController;
use App\Http\Controllers\Management\BranchController;
use App\Http\Controllers\Management\BranchOpeningHoursSettingController;
use App\Http\Controllers\Management\SignInController as ManagementSignInController;
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

Route::prefix('app')->group(function () {
    Route::middleware('auth:customer')->group(function () {
    });
});

Route::prefix('management')->group(function () {
    Route::post('/sign-in', ManagementSignInController::class);

    Route::middleware(['auth:user'])->group(function () {
        Route::apiResource('branches', BranchController::class);
        Route::apiSingleton('branches.address', BranchAddressController::class)->creatable();
        Route::apiResource('branches.opening-hours', BranchOpeningHoursSettingController::class);
    });
});
