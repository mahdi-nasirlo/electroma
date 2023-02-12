<?php

namespace Modules\Information\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'alt',
        'name',
        'path',
        'collection',
        'bannerable_type',
        'bannerable_id',
    ];

    public function bannerable()
    {
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return \Modules\Information\Database\factories\BannerFactory::new();
    }
}
