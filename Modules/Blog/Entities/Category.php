<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Tags\HasTags;

// TODO: add slug
class Category extends Model
{
    use HasFactory, NodeTrait, HasSEO;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'is_visible',
    ];
    protected $table = "blog_categories";

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
        return \Modules\Blog\Database\factories\CategoryFactory::new();
    }
}
