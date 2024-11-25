<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IDController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::delete('/delete', [IDController::class, 'destroy']);
});

Route::get('/login', [SessionController::class, 'create']);

Route::post('/login', [SessionController::class, 'store']);

Route::delete('/logout', [SessionController::class, 'destroy']);

Route::get('/first', [IDController::class, 'createDataFirstPage'])->name('first-page-data');

Route::post('/first', [IDController::class, 'storeData']);

Route::get('/seconde/{uuid}', [IDController::class, 'createDataSecondePage'])->name('seconde-page-data');

Route::post('/seconde/{uuid}', [IDController::class, 'storeSecondeData']);

Route::get('/id-front-side/{uuid}', [IDController::class, 'captureFrontSide'])->name('capture-front-side');

Route::post('/store-front-side/{uuid}', [IDController::class, 'storeFrontSide']);

Route::get('/id-back-side/{uuid}', [IDController::class, 'captureBackSide'])->name('capture-back-side');

Route::post('/store-back-side/{uuid}', [IDController::class, 'storeBackSide']);

Route::get('/selfie/{uuid}', [IDController::class, 'captureSelfie'])->name('capture-selfie');

Route::post('/store-selfie/{uuid}', [IDController::class, 'storeSelfie']);

Route::get('/wait-verification/{uuid}', [IDController::class, 'waitForVerification'])->name('wait-verification');
