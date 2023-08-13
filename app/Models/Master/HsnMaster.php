<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HsnMaster extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'hsn_code', 'gst', 'cgst','sgst','description'
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'hsn_code'              => 'required|max:255|unique:hsn_masters,hsn_code',
        'gst'                   => 'required|numeric|min:0',
        'cgst'                  => 'required|numeric|min:0',
        'sgst'                  => 'required|numeric|min:0',
        
    ];
}
