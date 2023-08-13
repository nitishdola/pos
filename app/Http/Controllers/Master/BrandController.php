<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Brand;
use Validator, Redirect, Crypt;
class BrandController extends Controller
{
    public function create() {
        return view('master.brand.create');
    }

    public function save(Request $request) {
       $rules = [
            'name' => 'required|max:255',
        ];
        $data = ['name' => ucwords(strtolower($request->name))];
        

        $validator = Validator::make($data, $rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $brand = Brand::updateOrCreate($data);

        return Redirect::route('master.brand.index')->with(['message' => 'Brand added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = Brand::where('deleted_at', NULL)->orderBy('name')->get();
        return view('master.brand.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $brand = Brand::findOrFail($id);
        return view('master.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $brand = Brand::findOrFail($id);
        $brand->name = ucwords(strtolower($request->name));
        $brand->save();

        return Redirect::route('master.brand.index')->with(['message' => 'Brand updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $brand = Brand::findOrFail($id);
        $brand->deleted_at = date('Y-m-d H:i:s');
        $brand->save();

        return Redirect::route('master.brand.index')->with(['message' => 'Brand deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
