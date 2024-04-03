<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Period;
use App\Models\Pet;
use App\Models\Review;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified']);
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/user/{id}', function (Request $request, string $id) {
    return view('/profile.detail', [
        'user' => User::where('id', $id)->firstOrFail(),
        'pets' => Pet::where('user_id', $id)->get(),
        'jobs' => Period::where('assigned_to_id', $id)->get(),
        'requests' => Period::where('user_id', $id)->get(),
        'rating' => DB::table('reviews')
            ->leftJoin('periods', 'reviews.period_id', '=', 'periods.id')
            ->leftJoin('users', 'periods.assigned_to_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->where('reviews.rating', '!=', null)
            ->avg('reviews.rating'),
        'review_amount' => DB::table('reviews')
            ->leftJoin('periods', 'reviews.period_id', '=', 'periods.id')
            ->leftJoin('users', 'periods.assigned_to_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->where('reviews.rating', '!=', null)
            ->count('reviews.rating'),
    ]);
})->middleware(['auth', 'verified']);

Route::get('/user/{id}/reviews', function (Request $request, string $id) {
    return view('/profile/partials/reviews', [
        'user' => User::where('id', $id)->firstOrFail(),
        'reviews' => DB::table('reviews')
            ->select('reviews.id', 'reviews.rating', 'reviews.review', 'reviews.updated_at', 'users.name', 'users.image', 'users.id as user_id', 'periods.start_date as start_date', 'periods.end_date as end_date', 'pets.name as pet')
            ->join('periods', 'reviews.period_id', '=', 'periods.id')
            ->join('users', 'periods.user_id', '=', 'users.id')
            ->join('pets', 'periods.pet_id', '=', 'pets.id')
            ->where('periods.assigned_to_id', '=', $id)
            ->where('reviews.rating', '!=', null)
            ->get(),
    ]);
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'addAvatar'])->name('profile.addAvatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatarDelete', [ProfileController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
    Route::patch('/profile/addDescription', [ProfileController::class, 'addDescription'])->name('profile.addDescription');
});

Route::resource('pets', PetController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('requests', PeriodController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'assignTo'])
    ->middleware(['auth', 'verified']);

Route::patch('/requests.assignTo', [PeriodController::class, 'assignTo'])->name('requests.assignTo')
    ->middleware(['auth', 'verified']);

Route::resource('comments', CommentController::class)
    ->only(['index','store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('reviews', ReviewController::class)
    ->only(['index', 'update'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
