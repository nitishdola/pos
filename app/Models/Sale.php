<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'consignee_name', 'consignee_address', 'consignee_district_id', 
        'invoice_date','invoice_number', 'user_id'
    ];

    protected $guarded      = ['_token'];

    public static $rules    = [
        'invoice_number'            => 'required|max:127',
        'user_id'                   => 'required|exists:users,id',
        
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Master\District', 'consignee_district_id');
    }

    public function sale_items()
    {
        return $this->hasMany('App\Models\SaleItem', 'sales_id');
    }
}
