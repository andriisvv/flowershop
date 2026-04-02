<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'email',
        'address', 'comment', 'total', 'status'
    ];
    protected $attributes = [
    'status' => 'pending',
];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending'    => 'Очікує',
            'confirmed'  => 'Підтверджено',
            'delivering' => 'Доставляється',
            'completed'  => 'Виконано',
            'cancelled'  => 'Скасовано',
            default      => $this->status,
        };
    }

    public function getStatusClassAttribute()
    {
        return match($this->status) {
            'pending'    => 'status-pending',
            'confirmed'  => 'status-confirmed',
            'delivering' => 'status-delivering',
            'completed'  => 'status-completed',
            'cancelled'  => 'status-cancelled',
            default      => '',
        };
    }
}