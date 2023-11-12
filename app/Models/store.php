<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['store_add', 'manager_user_id', 'manager', 'mobile_no'];

    // Define the relationship with the User model
    public function managerUser()
    {
        return $this->belongsTo(User::class, 'manager_user_id');
    }
}
