<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\ServiceItemFactory::new();
    }
}
