<?php

namespace Modules\Course\Entities;

use App\Models\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jackiedo\Cart\Contracts\UseCartable;
use Jackiedo\Cart\Traits\CanUseCart;
use Modules\Payment\Entities\DiscountItem;
use Modules\Payment\Entities\Order;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;


class Course extends Model implements UseCartable
{
    use CanUseCart;
    use HasFactory;
    use Sluggable;
    use HasTags;
    use HasSEO;

    protected $fillable = ['title', 'common_questions', 'attributes', "attributes", 'short_desc', 'slug', 'desc', 'price', 'inventory', "published_at", 'view', 'image', 'user_id'];

    protected $appends = [
        'discounted_price',
    ];

    public function getDiscountedPriceAttribute()
    {
        // return $this->discountItem ? $this->attributes['price'] : 0;
        return $this->discountItem ? (int) $this->attributes['price'] - ($this->attributes['price'] *  ($this->discountItem->percent / 100)) : $this->attributes['price'];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected $casts = [
        'published_at' => 'date',
        'attributes' => 'array',
        'common_questions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // public function commonQuestions(): HasMany
    // {
    //     return $this->hasMany(CommonQuestion::class, 'course_id');
    // }

    // public function attributes(): HasMany
    // {
    //     return $this->hasMany(Attribute::class, 'course_id');
    // }

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable', "orderables");
    }

    public function discountItem()
    {
        return $this->belongsTo(DiscountItem::class, "discount_id");
    }

    protected static function newFactory()
    {
        return \Modules\Course\Database\factories\CourseFactory::new();
    }
}
