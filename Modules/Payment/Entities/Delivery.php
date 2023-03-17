<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'take_time',
        'status',
        'free_con'
    ];

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\DeliveryFactory::new();
    }
}
