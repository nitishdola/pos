<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class APIController extends Controller
{
    public function getHsnDetails(Request $request) {
        return DB::table('hsn_masters')->select('id', 'hsn_code', 'gst')->where('id', $request->id)->first();
    }
}
