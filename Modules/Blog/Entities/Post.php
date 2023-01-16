<?php

namespace Modules\Blog\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory, HasSEO, HasTags;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
        'seo_title',
        'seo_description',
        'read_time',
        'view',
        'image',
        "blog_category_id",
        'blog_author_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
    ];

    protected $table = "blog_posts";

    public function user()
    {
        return $this->belongsTo(User::class, 'blog_author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'blog_category_id');
    }

    // public function comments()
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }
}
