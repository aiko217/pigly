<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
use App\Http\Requests\LoginRequest;
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
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/initial_weight', [AuthController::class, 'initial_weight'])->name('initial_weight');
Route::post('/initial_weight', [AuthController::class, 'storeInitialWeight'])->name('store_initial_weight');
Route::get('/complete-registration', [AuthController::class, 'completeRegistration'])->name('complete_registration');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [WeightLogController::class, 'admin'])->name('admin');
    Route::resource('weights', WeightLogController::class)->except(['show']);

    Route::get('/search', [WeightLogController::class, 'search'])->name('weights.search');
    Route::get('/goal', [WeightLogController::class, 'goal'])->name('weights.goal');
    Route::post('/goal', [WeightLogController::class, 'updateGoal'])->name('weights.goal.update');
   Route::get('/target-weight/edit', [WeightLogController::class, 'editTarget'])->name('target_weight.edit');
    Route::put('/target-weight', [WeightLogController::class, 'updateTarget'])->name('target_weight.update');    
});
