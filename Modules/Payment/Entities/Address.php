<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'state',
        'city',
        'address',
        'post',
        'mobile'
    ];

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\AddressFactory::new();
    }
}
