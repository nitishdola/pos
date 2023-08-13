<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Category;
use Validator, Redirect, Crypt;
class CategoryController extends Controller
{
    public function create() {
        return view('master.category.create');
    }

    public function save(Request $request) {
       $rules = [
            'name' => 'required|max:255',
        ];
        $data = ['name' => ucwords(strtolower($request->name))];
        

        $validator = Validator::make($data, $rules);
            if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $category = Category::updateOrCreate($data);

        return Redirect::route('master.category.index')->with(['message' => 'Category added successfully !', 'alert-class' => 'alert-success']);
    }

    public function index(Request $request) {
        $results = Category::where('deleted_at', NULL)->orderBy('name')->get();
        return view('master.category.index', compact('results'));
    }

    public function edit(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $category = Category::findOrFail($id);
        return view('master.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $category = Category::findOrFail($id);
        $category->name = ucwords(strtolower($request->name));
        $category->save();

        return Redirect::route('master.category.index')->with(['message' => 'Category updated successfully !', 'alert-class' => 'alert-success']);
    }

    public function remove(Request $request, $id) {
        $id = Crypt::decrypt($id);
        $category = Category::findOrFail($id);
        $category->deleted_at = date('Y-m-d H:i:s');
        $category->save();

        return Redirect::route('master.category.index')->with(['message' => 'Category deleted successfully !', 'alert-class' => 'alert-success']);
    }
}
