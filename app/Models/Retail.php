<?php

namespace App\Models;

use App\Models\User; // Import the User model
use Illuminate\Database\Eloquent\Model;

class Retail extends Model
{
    // Define the table associated with the model
    protected $table = 'stores';

    // Specify the fillable columns
    protected $fillable = [
        'user_id', 
        'store_add', 
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
