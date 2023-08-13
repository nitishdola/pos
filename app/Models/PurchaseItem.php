<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PurchaseItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'purchase_id', 'item_id', 'hsn_master_id', 'quantity','expiry_date', 'manufacturing_date',
        'gst','unit_cost','mrp',
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'manufacturing_date'        => 'date|date_format:Y-m-d',
        'expiry_date'               => 'date|date_format:Y-m-d',
        'quantity'                  => 'required|numeric|min:0',
        'gst'                       => 'required|numeric|min:0',
        'unit_cost'                 => 'required|numeric|min:0',
        'mrp'                       => 'required|numeric|min:0',
        'item_id'                   => 'required|exists:items,id',
        'hsn_master_id'             => 'required|exists:hsn_masters,id',
        'purchase_id'               => 'required|exists:purchases,id',
        
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Master\Item', 'item_id');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase', 'purchase_id');
    }

    public function hsn_master()
    {
        return $this->belongsTo('App\Models\Master\HsnMaster', 'hsn_master_id');
    }
}
