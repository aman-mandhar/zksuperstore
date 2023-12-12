<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;
use App\Models\Retail;
use App\Models\Subwarehouse;
use App\Models\Warehouse;
use App\Models\Stock;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'item_id',
        'user_id',
        'measure',
        'tot_no_of_items',
        'points',
        'sale_price',
        'status',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}