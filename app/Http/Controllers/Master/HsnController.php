<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\HsnMaster;
use Validator, Redirect, Crypt;

class HsnController extends Controller
{
    public function create() {
        return view('master.hsn.create');
    }

    public function save(Request $request) {
       
        $data = [
            'hsn_code' => $request->hsn_code,
            'gst' => $request->gst,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'description' => $request->description,
        ];
        

        $validator = Validator::make($data, HsnMaster::$rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $hsn = HsnMaster::updateOrCreate($data);

        return Redirect::route('master.hsn.index')->with(['message' => 'HSN Master added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = HsnMaster::where('deleted_at', NULL)->get();
        return view('master.hsn.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $hsn = HsnMaster::findOrFail($id);
        return view('master.hsn.edit', compact('hsn'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $hsn = HsnMaster::findOrFail($id);
        $hsn->hsn_code = $request->hsn_code;
        $hsn->gst = $request->gst;
        $hsn->cgst = $request->gst;
        $hsn->sgst = $request->sgst;
        $hsn->description = $request->description;
        $hsn->save();

        return Redirect::route('master.hsn.index')->with(['message' => 'hsn updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $hsn = HsnMaster::findOrFail($id);
        $hsn->deleted_at = date('Y-m-d H:i:s');
        $hsn->save();

        return Redirect::route('master.hsn.index')->with(['message' => 'hsn deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
