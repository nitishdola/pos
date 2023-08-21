<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\REST\APIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/get-hsn-details', [APIController::class, 'getHsnDetails'])->name('get_hsn_details');
Route::get('/get-all-purchase-details', [APIController::class, 'getAllPurchaseDetails'])->name('get_all_purchase_details');
Route::get('/get-purchase-item-details', [APIController::class, 'getPurchaseItemDetails'])->name('get_purchase_item_details');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
