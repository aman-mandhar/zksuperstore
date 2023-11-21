<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_id',
        'measure',
        'qrcode',
        'pur_value',
        'tot_no_of_items',
        'mrp',
        'gst',
        'cgst',
        'transit_charges',
        'tot_pur_value',
        'pur_bill_no',
        'merchant',
        'sale_price',
        'tot_issued_points',
        'wh_id',
    ];

    // Add any relationships or additional methods as needed
}
