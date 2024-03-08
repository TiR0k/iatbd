<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Models\Pet;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/{id}', function (Request $request, string $id) {
    return view('/profile.detail', [
        'user' => User::where('id', $id)->firstOrFail(),
        'pets' => Pet::where('user_id', $id)->get()
    ]);
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'addAvatar'])->name('profile.addAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatarDelete', [ProfileController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
});

Route::resource('pets', PetController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
