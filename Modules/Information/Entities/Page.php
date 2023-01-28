<?php

namespace Modules\Information\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        "content",
        "name",
        "slug"
    ];

    protected static function newFactory()
    {
        return \Modules\Information\Database\factories\PageFactory::new();
    }
}
