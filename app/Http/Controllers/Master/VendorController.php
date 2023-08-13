<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Vendor;
use Validator, Redirect, Crypt;
class VendorController extends Controller
{
    public function create() {
        return view('master.vendor.create');
    }

    public function save(Request $request) {
       $rules = [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'contact_number' => 'max:255',
            'email' => 'max:255',
        ];
        $data = [
            'name' => ucwords(strtolower($request->name)),
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
        ];
        

        $validator = Validator::make($data, $rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $vendor = Vendor::updateOrCreate($data);

        return Redirect::route('master.vendor.index')->with(['message' => 'Vendor added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = Vendor::where('deleted_at', NULL)->orderBy('name')->get();
        return view('master.vendor.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $vendor = Vendor::findOrFail($id);
        return view('master.vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $vendor = Vendor::findOrFail($id);
        $vendor->name = ucwords(strtolower($request->name));
        $vendor->address = $request->address;
        $vendor->contact_number = $request->contact_number;
        $vendor->email = $request->email;
        $vendor->save();

        return Redirect::route('master.vendor.index')->with(['message' => 'vendor updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $vendor = Vendor::findOrFail($id);
        $vendor->deleted_at = date('Y-m-d H:i:s');
        $vendor->save();

        return Redirect::route('master.vendor.index')->with(['message' => 'vendor deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
