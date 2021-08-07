<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\UserController;
use App\Models\HomeSlider;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', 'dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });
    Route::prefix('brands')->name('brands.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('delete');
    });

    Route::prefix("categories")->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('restore');
        Route::get('/force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('force-delete');
    });
    Route::prefix("sliders")->name('sliders.')->group(function () {
        Route::get('/', [HomeSliderController::class, 'index'])->name('index');
        Route::post('/store', [HomeSliderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [HomeSliderController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [HomeSliderController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [HomeSliderController::class, 'delete'])->name('delete');
    });


    Route::get('multi-image', [MultiImageController::class, 'index'])->name('multi-image.index');
    Route::post('multi-image', [MultiImageController::class, 'store'])->name('mutli-image.store');
});
