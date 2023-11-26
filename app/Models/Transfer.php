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
        'stock_id',
        'weight',
        'qty',
        'points',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }

}
