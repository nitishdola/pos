<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'item_name', 'volume', 'category_id','unit_id','brand_id','stock_in_hand'
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'item_name'             => 'required|max:255',
        'volume'                => 'required',
        'category_id'           => 'required|exists:categories,id',
        'unit_id'               => 'required|exists:units,id',
        'brand_id'              => 'required|exists:brands,id',
        
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Master\Category', 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Master\Unit', 'unit_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Master\Brand', 'brand_id');
    }

}
