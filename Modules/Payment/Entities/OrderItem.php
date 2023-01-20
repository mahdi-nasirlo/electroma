<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderables';

    protected $fillable = [
        'orderable_id',
        'orderable_type',
        'price',
    ];

    public $timestamps  = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\OrderItemFactory::new();
    }
}
