<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'uuid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    protected static function booted()
    {
        static::creating(function ($cart) {
            $cart->uuid = Str::uuid();
        });
    }
}
