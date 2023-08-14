<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\HsnMaster;
use App\Models\Master\Vendor;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Validator, Redirect, Crypt, DB;
class PurchaseController extends Controller
{
    public function create() {
        $items = Item::query()
            ->join('brands', 'items.brand_id', '=', 'brands.id')
            ->join('units', 'items.unit_id', '=', 'units.id')
            ->select([
                DB::raw("CONCAT(brands.name, ' - ', items.item_name, ' ', items.volume, ' ',units.name) as i_name, items.id as item_id"),
            ])
            ->where('items.deleted_at', null)
            ->pluck('i_name', 'item_id');

        $hsn_codes = HsnMaster::where('deleted_at', null)->pluck('hsn_code', 'id');
        $vendors = Vendor::where('deleted_at', null)->pluck('name', 'id');
        return view('purchase.create', compact('items', 'hsn_codes', 'vendors'));
    }

    public function save(Request $request) {
        $items = $request->item_id;

        $po = [];

        $po['purchase_date']    = date('Y-m-d', strtotime($request->purchase_date));
        $po['invoice_number']   = $request->invoice_number;
        $po['invoice_date']     = date('Y-m-d', strtotime($request->invoice_date));
        $po['discount']         = $request->discount;
        $po['user_id']          = auth()->user()->id;
        $po['vendor_id']        = $request->vendor_id;

        $validator = Validator::make($po, Purchase::$rules);

        if ($validator->fails()) {
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        if($po = Purchase::create($po)) {
            for($i = 0; $i < count($items); $i++) {
                $data = [];

                if(
                    $request->item_id[$i] != '' &&
                    $request->hsn_master_id[$i] != '' &&
                    $request->quantity[$i] != '' &&
                    $request->gst[$i] != '' &&
                    $request->unit_cost[$i] != '' &&
                    $request->mrp[$i] != ''
                ) {
                    $data['item_id']        = $items[$i];
                    $data['hsn_master_id']  = $request->hsn_master_id[$i];
                    $data['quantity']       = $request->quantity[$i];
                    if($request->expiry_date[$i]):
                        $data['expiry_date']    = date('Y-m-d', strtotime('01-'.$request->expiry_date[$i]));
                    endif;
                    if($request->manufacturing_date[$i]):
                        $data['manufacturing_date'] = date('Y-m-d', strtotime('01-'.$request->manufacturing_date[$i]));
                    endif;
                    $data['gst']            = $request->gst[$i];
                    $data['unit_cost']      = $request->unit_cost[$i];
                    $data['mrp']            = $request->mrp[$i];
                    $data['purchase_id']    = $po->id;

                    $validator = Validator::make($data, PurchaseItem::$rules);

                    if ($validator->fails()) {
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
                    }
                    $po_item = PurchaseItem::create($data);
                }
            }    
        }

        DB::commit();

        return Redirect::route('po.details', Crypt::encrypt($po->id))->with(['message' => 'Purchase Order created successfully !', 'alert-class' => 'alert-success']);

    }

    public function index(Request $request) {
        $results = Purchase::orderBy('purchase_date', 'DESC')->with('vendor')->get();
        return view('purchase.index', compact('results'));
    }

    public function details($id) {
        $id = Crypt::decrypt($id);
        $result = Purchase::whereId($id)->with('vendor', 'purchase_items')->first();
        //dd($result);
        return view('purchase.view', compact('result'));
    }
}
