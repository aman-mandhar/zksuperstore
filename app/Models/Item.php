<?php
// app\Models\Item.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'Description', 'prod_cat', 'prod_pic'];

    // Additional methods, relationships, etc. can be added here
}
