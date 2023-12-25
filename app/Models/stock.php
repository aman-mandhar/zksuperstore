<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;

class Stock extends Model
{
    protected $fillable = [
        'item_id',
        'subcategory_id',
        'variation_id',
        'measure',
        'tot_no_of_items',
        'pur_value',
        'gst',
        'mrp',
        'sale_price',
        'tot_points',
        'prod_cat',
        'type',
        'pur_bill_pic',
        'pur_bill_no',
        'pur_date',
        'merchant',
        'qrcode',
        'barcode',
        'batch_no',
        'mfg_date',
        'exp_date',
        'status',
        'remarks',
        'user_id',
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

    public function subcategory()
    {
        return $this->belongsTo(ProductSubcategory::class, 'subcategory_id');
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    
    }
}
