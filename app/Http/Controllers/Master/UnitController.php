<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Unit;
use Validator, Redirect, Crypt;
class UnitController extends Controller
{
    public function create() {
        return view('master.unit.create');
    }

    public function save(Request $request) {
       $rules = [
            'name' => 'required|max:255',
        ];
        $data = ['name' => ucwords(strtolower($request->name))];
        

        $validator = Validator::make($data, $rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $unit = Unit::updateOrCreate($data);

        return Redirect::route('master.unit.index')->with(['message' => 'Unit added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = Unit::where('deleted_at', NULL)->orderBy('name')->get();
        return view('master.unit.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $unit = Unit::findOrFail($id);
        return view('master.unit.edit', compact('unit'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $unit = Unit::findOrFail($id);
        $unit->name = ucwords(strtolower($request->name));
        $unit->save();

        return Redirect::route('master.unit.index')->with(['message' => 'Unit updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $unit = Unit::findOrFail($id);
        $unit->deleted_at = date('Y-m-d H:i:s');
        $unit->save();

        return Redirect::route('master.unit.index')->with(['message' => 'Unit deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
