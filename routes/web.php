<?php

use App\Http\Controllers\BedroomController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [UserController::class, 'index'])->name('index.user');
Route::middleware(['auth:sanctum', 'verified'])->get('/role', [RoleController::class, 'index'])->name('index.role');
Route::middleware(['auth:sanctum', 'verified'])->put('/update_role_to_user/{id}', [UserController::class, 'update_role'])->name('update_role.user');
Route::middleware(['auth:sanctum', 'verified'])->get('/bedrooms', [BedroomController::class, 'index'])->name('index.bedroom');
Route::middleware(['auth:sanctum', 'verified'])->get('/bedrooms/{search}/{column}', [BedroomController::class, 'search'])->name('search.bedroom');
Route::middleware(['auth:sanctum', 'verified'])->post('/bedrooms',[BedroomController::class, 'store'])->name('store.bedroom');
Route::middleware(['auth:sanctum', 'verified'])->put('/bedrooms/{id}',[BedroomController::class, 'update'])->name('update.bedroom');