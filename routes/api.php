<?php

use App\Http\Controllers\api\CustomerController;
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

Route::get('/customers/get-all', [CustomerController::class, 'index'])->name('index');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('store');
Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('show');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('update');
Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('delete');
