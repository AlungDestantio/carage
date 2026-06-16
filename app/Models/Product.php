<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = ['category_id','name','slug','description','price','stock','image','brand','sku','is_featured','is_active'];
    protected $casts    = ['price'=>'decimal:2','is_featured'=>'boolean','is_active'=>'boolean'];

    public function category()   { return $this->belongsTo(Category::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function cartItems()  { return $this->hasMany(Cart::class); }

    public function getFormattedPriceAttribute(): string {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    protected static function boot() {
        parent::boot();
        static::creating(fn($p) => $p->slug = Str::slug($p->name));
    }
}