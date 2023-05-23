<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
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

// middleware per autenticati
Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {
    // inseriammo la dashboard sotto l'autenticazione
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/projects', ProjectController::class);
    Route::resource('projects', ProjectController::class)->parameters(['projects'=>'project:slug']);
});

require __DIR__.'/auth.php';
