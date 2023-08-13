<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'vendor_id', 'purchase_date', 'invoice_number', 'invoice_date','discount', 'user_id'
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'purchase_date'             => 'required|date|date_format:Y-m-d',
        'invoice_date'              => 'required|date|date_format:Y-m-d',
        'invoice_number'            => 'required|max:127',
        'user_id'                   => 'required|exists:users,id',
        'vendor_id'                 => 'required|exists:vendors,id',
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Master\Vendor', 'vendor_id');
    }
    public function purchase_items()
    {
        return $this->hasMany('App\Models\PurchaseItem');
    }
}
