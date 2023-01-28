<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'message',
        'item_id',
        "status"
    ];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\ServiceFactory::new();
    }
}
