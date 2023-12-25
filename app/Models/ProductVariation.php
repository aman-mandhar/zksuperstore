<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = ['subcategory_id', 'color', 'size'];

    public function subcategory()
    {
        return $this->belongsTo(ProductSubcategory::class);
    }
}
