<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Variant extends Model
{
    /** @use HasFactory<\Database\Factories\VarientFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['size', 'color', 'price_override', 'stock_qty', 'product_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::creating(function ($varient) {
            $varient->slug = Str::slug($varient->product->name);
        });
        static::updating(function ($varient) {
            $varient->slug = Str::slug($varient->product->name);
        });
    }
}
