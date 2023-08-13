<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\BrandController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\UnitController;
use App\Http\Controllers\Master\ItemsController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Master\HsnController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'master','as'=>'master.'], function(){
    Route::group(['prefix'=>'brand','as'=>'brand.'], function(){
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/save', [BrandController::class, 'save'])->name('save');
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [BrandController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'category','as'=>'category.'], function(){
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/save', [CategoryController::class, 'save'])->name('save');
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [CategoryController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'unit','as'=>'unit.'], function(){
        Route::get('/create', [UnitController::class, 'create'])->name('create');
        Route::post('/save', [UnitController::class, 'save'])->name('save');
        Route::get('/', [UnitController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [UnitController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UnitController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'item','as'=>'item.'], function(){
        Route::get('/create', [ItemsController::class, 'create'])->name('create');
        Route::post('/save', [ItemsController::class, 'save'])->name('save');
        Route::get('/', [ItemsController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [ItemsController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [ItemsController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ItemsController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'vendor','as'=>'vendor.'], function(){
        Route::get('/create', [VendorController::class, 'create'])->name('create');
        Route::post('/save', [VendorController::class, 'save'])->name('save');
        Route::get('/', [VendorController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [VendorController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [VendorController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [VendorController::class, 'update'])->name('update');
    });

    Route::group(['prefix'=>'hsn','as'=>'hsn.'], function(){
        Route::get('/create', [HsnController::class, 'create'])->name('create');
        Route::post('/save', [HsnController::class, 'save'])->name('save');
        Route::get('/', [HsnController::class, 'index'])->name('index');
        Route::get('/remove/{id}', [HsnController::class, 'remove'])->name('remove');
        Route::get('/edit/{id}', [HsnController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [HsnController::class, 'update'])->name('update');
    });
});

Route::group(['prefix'=>'purchase-order','as'=>'po.'], function(){
    Route::get('/create', [PurchaseController::class, 'create'])->name('create');
    Route::post('/save', [PurchaseController::class, 'save'])->name('save');
    Route::get('/', [PurchaseController::class, 'index'])->name('index');
    Route::get('/details/{id}', [PurchaseController::class, 'details'])->name('details');
});

Route::group(['prefix'=>'sales','as'=>'sales.'], function(){
    Route::get('/create', [SalesController::class, 'create'])->name('create');
    Route::post('/save', [SalesController::class, 'save'])->name('save');
    Route::get('/', [SalesController::class, 'index'])->name('index');
    Route::get('/details/{id}', [SalesController::class, 'details'])->name('details');
});

