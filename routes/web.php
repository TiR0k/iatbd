<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware(["auth"])->group(function (){
    Route::get("/dieren/create", [\App\Http\Controllers\PetController::class, "create"]);
    Route::post("/dieren", [\App\Http\Controllers\PetController::class, "store"]);

    Route::get("/dieren", [\App\Http\Controllers\PetController::class, "index"]);
    Route::get("/dieren/{id}", [\App\Http\Controllers\PetController::class, "show"]);

    Route::get("/baasjes", [\App\Http\Controllers\UserController::class, "index"]);
    Route::get("/baasjes/{id}", [\App\Http\Controllers\UserController::class, "show"]);



    Route::get('/', [\App\Http\Controllers\PetController::class, "home"]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
