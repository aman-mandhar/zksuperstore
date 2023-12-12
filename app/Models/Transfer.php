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
        'store_id',
        'subwarehouse_id',
        'warehouse_id',
        'user_id',
        'measure',
        'tot_no_of_items',
        'points',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

    public function store()
    {
        return $this->belongsTo(Retail::class, 'store_id');
    }

    public function subwarehouse()
    {
        return $this->belongsTo(Subwarehouse::class, 'subwarehouse_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }   

}
