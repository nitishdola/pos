<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\HsnMaster;
use App\Models\Master\Vendor;
use App\Models\Master\District;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Sale;
use App\Models\SaleItem;


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
        $districts = District::pluck('name', 'id');
        return view('sales.create', compact('items', 'districts'));
    }

    public function save(Request $request) {
    
        $item_ids = $request->item_id;

        $consignee_data = [];

        $consignee_data['consignee_name']           = $request->consignee_name;
        $consignee_data['consignee_address']        = $request->consignee_address;
        $consignee_data['consignee_district_id']    = $request->consignee_district_id;
        $consignee_data['invoice_date']             = $request->invoice_date;
        $consignee_data['invoice_number']           = 'AIE/0002/23-24';
        $consignee_data['user_id']                  = auth()->user()->id;

        $validator = Validator::make($consignee_data, Sale::$rules);
        if ($validator->fails()) {
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        if($sale = Sale::create($consignee_data)) {
            for($k = 0; $k < count($item_ids); $k++) {
                $item_id            = $request->item_id[$k];
                $purchase_item_id   = $request->purchase_item_id[$k];
                $sell_price         = $request->sell_price[$k];
                $quantity           = $request->quantity[$k];

                $purchase_item = PurchaseItem::find($purchase_item_id);
    
                $data = [];
    
                $data['item_id']            = $item_id;
                $data['sales_id']           = $sale->id;
                $data['purchase_item_id']   = $purchase_item_id;
                $data['purchase_price']     = $purchase_item->unit_cost;
                $data['sell_price']         = $sell_price;
                $data['gst']                = $purchase_item->gst;
                $data['quantity']           = $quantity;
                
                $validator = Validator::make($data, SaleItem::$rules);
                if ($validator->fails()) {
                    if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
                }

                SaleItem::create($data);

                //update the current stock
                $purchase_item = PurchaseItem::find($purchase_item_id);
                $current_stock = $purchase_item->current_stock;

                $purchase_item->current_stock = $current_stock - $quantity;
                $purchase_item->save();

            }
        }

        DB::commit();

        return Redirect::route('sales.details', Crypt::encrypt($sale->id))->with(['message' => 'Invoice created successfully !', 'alert-class' => 'alert-success']);
    }

    public function details($id) {
        $id = Crypt::decrypt($id);
        $sale = Sale::whereId($id)->with('user', 'sale_items', 'district')->first();
        return view('sales.invoice', compact('sale'));
    }
}
