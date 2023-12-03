<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Stock extends Model
{
    protected $fillable = [
        'item_id',
        'prod_pic',
        'name',
        'description',
        'type',
        'prod_cat',
        'measure',
        'tot_no_of_items',
        'pur_value',
        'gst',
        'mrp',
        'sale_price',
        'tot_points',
        'pur_bill_no',
        'merchant',
        'user_id',
        'qrcode',
    ];
    
    // Relationships
    
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant');
    }
}