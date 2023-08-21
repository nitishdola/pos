<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class APIController extends Controller
{
    public function getHsnDetails(Request $request) {
        return DB::table('hsn_masters')->select('id', 'hsn_code', 'gst')->where('id', $request->id)->first();
    }

    public function getAllPurchaseDetails(Request $request) {
        return DB::table('purchase_items')
                    ->join('purchases', 'purchases.id', '=', 'purchase_items.purchase_id')
                    ->where('purchase_items.item_id', $request->item_id)
                    ->select('purchases.id', 'purchases.invoice_number', 'purchases.purchase_date', 'purchase_items.id as purchase_item_id')
                    ->get();
    }

    public function getPurchaseItemDetails(Request $request) {
        return DB::table('purchase_items')->where('id', $request->purchase_item_id)->first();
    }
}
