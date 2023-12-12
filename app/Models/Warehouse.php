<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    // Define the table associated with the model
    protected $table = 'warehouses';

    // Specify the fillable columns
    protected $fillable = [
        'user_id', 
        'add', 
        'city', 
        'manager', 
        'mobile_no'
    ];

    // Eloquent relationship: a store belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
