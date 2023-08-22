<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SaleItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sales_id', 'purchase_item_id', 'sell_price', 'quantity', 'item_id', 'purchase_price', 'gst'
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'sales_id'          => 'required|exists:sales,id',
        'item_id'           => 'required|exists:items,id',
        'purchase_item_id'  => 'required|exists:purchase_items,id',
        'quantity'          => 'required|numeric|min:0',
        'sell_price'        => 'required|numeric',
        'purchase_price'    => 'required|numeric',
        'gst'               => 'required|numeric',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Master\Item', 'item_id');
    }

    public function purchase_item()
    {
        return $this->belongsTo('App\Models\PurchaseItem', 'purchase_item_id');
    }

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale', 'sales_id');
    }
}
