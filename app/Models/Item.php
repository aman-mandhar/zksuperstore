<?php
// app\Models\Item.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'prod_cat', 'prod_pic', 'type', 'gst'];

    public function stocks()
{
    return $this->hasMany(Stock::class);
}
}

