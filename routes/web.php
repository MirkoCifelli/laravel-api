<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectContoller;
use App\Http\Controllers\Admin\TypeController as AdminTypeContoller;
use App\Http\Controllers\Admin\TechnologyController as AdminTechnologyContoller;
use App\Http\Controllers\Admin\ContactController as AdminContactController;



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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');

    Route::resource('projects',AdminProjectContoller::class);

    Route::resource('types',AdminTypeContoller::class);

    Route::resource('technologies',AdminTechnologyContoller::class);
    
    Route::resource('contacts', AdminContactController::class)->only([
        'index',
        'show',
        'destroy',
    ]);

});

require __DIR__.'/auth.php';
