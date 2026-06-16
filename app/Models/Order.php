<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','order_number','total_amount','shipping_cost','status','payment_status','payment_method','shipping_address','recipient_name','recipient_phone','notes'];
    protected $casts    = ['total_amount'=>'decimal:2','shipping_cost'=>'decimal:2'];

    public function user()       { return $this->belongsTo(User::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function getFormattedTotalAttribute(): string {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string {
        return match($this->status) {
            'pending'    => 'warning',
            'processing' => 'info',
            'shipped'    => 'primary',
            'delivered'  => 'success',
            'cancelled'  => 'danger',
            default      => 'secondary',
        };
    }
}