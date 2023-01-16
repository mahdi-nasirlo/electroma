<?php

namespace Modules\Shop\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


// TODO: add Cartable to product

class Product extends Model implements HasMedia
{
    use HasFactory;
    // use CanUseCart;
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
        "slug",
        "name",
        "category_id"
    ];

    protected $casts = [
        "cover_tag" => "array",
        "short_information" => "array",
        'published_at' => "datetime",
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

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\ProductFactory::new();
    }
}
