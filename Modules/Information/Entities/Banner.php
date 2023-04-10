<?php

namespace Modules\Information\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Entities\Category as BlogCategory;
use Modules\Blog\Entities\Post;
use Modules\Shop\Entities\Category as ShopCategory;
use Modules\Shop\Entities\Product;
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

    protected $morphable = [
        []
    ];

    public function bannerable()
    {
        return $this->morphTo();
    }

    public function shopCategory()
    {
        return $this->belongsTo(ShopCategory::class, "bannerable_id");
    }

    public function getLink()
    {
        switch ($this->bannerable_type) {
            case get_class(new ShopCategory()):
                return route('shop.product.list', $this->bannerable);
            case get_class(new BlogCategory()):
                return route('blog.article.list', $this->bannerable);
            case get_class(new Page()):
                return route('pages', $this->bannerable);
            case get_class(new Product()):
                return route('shop.product.single', $this->bannerable);
            case get_class(new Post()):
                return route('blog.article.single', $this->bannerable);
            default:
                return '#';
        }
    }

    // public function getLlt()
    // {
    //     # code...
    // }

    protected static function newFactory()
    {
        return \Modules\Information\Database\factories\BannerFactory::new();
    }
}
