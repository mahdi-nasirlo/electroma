<?php

namespace Modules\Shop\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Category extends Model
{
    use HasFactory, NodeTrait, HasSEO, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'is_visible',
    ];
    protected $table = "shop_categories";

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\CategoryFactory::new();
    }
}
