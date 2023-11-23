<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

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
        'user_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
