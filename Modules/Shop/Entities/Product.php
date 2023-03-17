<?php

namespace Modules\Shop\Entities;

use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jackiedo\Cart\Contracts\UseCartable;
use Jackiedo\Cart\Traits\CanUseCart;
use Modules\Payment\Entities\DiscountItem;
use Modules\Payment\Entities\Order;
use Modules\Shop\Entities\Category;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


// TODO: add Cartable to product

class Product extends Model implements HasMedia, UseCartable
{
    use HasFactory;
    use CanUseCart;
    use HasSEO;
    use Sluggable;
    use InteractsWithMedia;

    protected $fillable = [
        "content",
        "published_at",
        "inventory",
        "cover_tag",
        "price",
        "cover",
        "short_information",
        "short_desc",
        "cover_hover",
        // "gallery",
        'tiered_price',
        "slug",
        "name",
        "category_id"
    ];

    protected $casts = [
        "cover_tag" => "array",
        "short_information" => "array",
        'published_at' => "datetime",
        'tiered_price' => 'array'
        // "gallery" => "array"
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $attribute = [
        'gallery',
        'discounted_price',
        // 'rate'
    ];

    protected $appends = [
        'discounted_price',
        'rate'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_product',
            'product_id',
            'attributes_id'
        )
            ->withPivot(['value']);
    }

    public function getRateAttribute()
    {
        if (!$this->comments()->count()) {
            return 0;
        }

        return ($this->comments()->sum('rating') / $this->comments()->count());
    }

    public function getGalleryAttribute()
    {
        return $this->getMedia("product.gallery");
    }

    public function getDiscountedPriceAttribute()
    {
        // return $this->attributes['price'];
        // return $this->discountItem ? $this->attributes['price'] : 0;
        return $this->discountItem ? (int) $this->attributes['price'] - ($this->attributes['price'] *  ($this->discountItem->percent / 100)) : $this->attributes['price'];
    }
    // FIXME check discord item percent if expierd is past

    public function getCoverUrl()
    {
        if (empty($this->cover))
            return "/placeholder.webp";
        else
            return "/storage/" . $this->cover;
    }

    public function discountItem()
    {
        return $this->belongsTo(DiscountItem::class, "discount_id");
    }

    public function discountItems()
    {
        return $this->belongsTo(DiscountItem::class, "discount_id");
    }

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\ProductFactory::new();
    }
}
