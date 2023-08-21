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
            ->with('purchase')
            ->where('items.deleted_at', null)
            ->pluck('i_name', 'item_id');
        return view('sales.create', compact('items'));
    }

    public function save(Request $request) {
    
        $item_ids = $request->item_id;

        $consignee_data = [];

        $consignee_data['consignee_name']           = $request->consignee_name;
        $consignee_data['consignee_address']        = $request->consignee_address;
        $consignee_data['consignee_district_id']    = $request->consignee_district_id;
        $consignee_data['invoice_date']             = $request->invoice_date;

        for($k = 0; $k < count($item_ids); $k++) {
            $item_id            = $request->item_id[$k];
            $purchase_item_id   = $request->purchase_item_id[$k];
            $sell_price         = $request->sell_price[$k];
            $quantity           = $request->quantity[$k];

            $data = [];

            $data['item_id']            = $item_id;
            $data['purchase_item_id']   = $purchase_item_id;
            $data['sell_price']         = $sell_price;
            $data['quantity']           = $quantity;

            dd($data);
        }

        
        
    }
}
