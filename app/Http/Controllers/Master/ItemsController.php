<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Item;
use App\Models\Master\Brand;
use App\Models\Master\Category;
use App\Models\Master\Unit;
use Validator, Redirect, Crypt;
class ItemsController extends Controller
{
    public function create() {
        $brands = Brand::where('deleted_at', null)->pluck('name', 'id');
        $categories = Category::where('deleted_at', null)->pluck('name', 'id');
        $units = Unit::where('deleted_at', null)->pluck('name', 'id');
        return view('master.item.create', compact('brands', 'categories', 'units'));
    }

    public function save(Request $request) {
        $data = request()->except(['_token']);

        $validator = Validator::make($data, Item::$rules);

        if ($validator->fails()) {
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();
        }
        $item = Item::updateOrCreate($data);

        return Redirect::route('master.item.index')->with(['message' => 'Item added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = Item::where('deleted_at', NULL)->with('category', 'unit', 'brand')->orderBy('item_name')->get();
        return view('master.item.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $brands = Brand::where('deleted_at', null)->pluck('name', 'id');
        $categories = Category::where('deleted_at', null)->pluck('name', 'id');
        $units = Unit::where('deleted_at', null)->pluck('name', 'id');
        $id = Crypt::decrypt($id);
        $item = Item::findOrFail($id);
        return view('master.item.edit', compact('item', 'brands', 'categories', 'units'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $item = Item::findOrFail($id);
        
        $data = [
            'item_name' => $request->item_name,
            'volume' => $request->volume,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'brand_id' => $request->brand_id,
        ];
        $item->fill($data);
        $item->save();

        return Redirect::route('master.item.index')->with(['message' => 'Item updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $item = Item::findOrFail($id);
        $item->deleted_at = date('Y-m-d H:i:s');
        $item->save();

        return Redirect::route('master.item.index')->with(['message' => 'Item deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
