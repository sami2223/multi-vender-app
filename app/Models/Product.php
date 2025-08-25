<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'code', 'name', 'description', 'price', 'status', 'approved_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeMine($query, User $user)
    {
        return $query->where('user_id', $user->id);
    } 
}

