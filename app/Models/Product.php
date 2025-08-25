<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'price',
    'status',
    'code',
    'user_id',
  ];

  protected $casts = [
    'price' => 'decimal:2',
  ];

  public function vendor(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
