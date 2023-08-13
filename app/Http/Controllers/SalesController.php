<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\HsnMaster;
use App\Models\Master\Vendor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Validator, Redirect, Crypt, DB;
class SalesController extends Controller
{

    public function create() {
        $items = Item::query()
            ->join('brands', 'items.brand_id', '=', 'brands.id')
            ->select([
                DB::raw("CONCAT(brands.name, ' - ', items.item_name) as i_name, items.id as item_id"),
            ])
            ->where('items.deleted_at', null)
            ->pluck('i_name', 'item_id');
        return view('sales.create', compact('items'));
    }
}
