<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    DashboardController,
    LoginController,
    UserController,
};
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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin,user'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('admin.dashboard.create');
Route::post('/dashboard', [DashboardController::class, 'store'])->name('admin.dashboard.store');
Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('admin.dashboard.edit');
Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('admin.dashboard.update');
Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('admin.dashboard.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
