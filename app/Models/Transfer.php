<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;
use App\Models\Retail;
use App\Models\Subwarehouse;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'weight',
        'qty',
        'subwarehouse_id',
        'retail_id',
        'customer_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function subwarehouse()
    {
        return $this->belongsTo(Subwarehouse::class, 'subwarehouse_id');
    }
    public function retail()
    {
        return $this->belongsTo(Retail::class, 'retail_id');
    }

}
