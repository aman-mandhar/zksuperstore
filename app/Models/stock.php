<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'name',
        'item_id',
        'measure',
        'qrcode',
        'pur_value',
        'tot_no_of_items',
        'mrp',
        'pur_bill_no',
        'merchant',
        'sale_price',
        'tot_points',
        'wh_id',
    ];

    // Define the relationship
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
