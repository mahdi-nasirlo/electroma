<?php

namespace Modules\Shop\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Category extends Model
{
    use HasFactory, HasSEO;

    use Sluggable,
        NodeTrait {
        NodeTrait::replicate insteadof Sluggable;
    }

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

    public function link()
    {
        return ($this->is_visible) ? route('shop.product.list', $this) : "javascript:void(0)";
    }

    public function hasChilde()
    {
        return $this->children->count() > 0;
    }

    public function getChildrenIds(&$arr)
    {
        $children = $this->children;
        foreach ($children as $child) {
            if ($child->children->count() > 0) {
                $arr[] = $child->id;
                $child->getChildrenIds($arr);
            } else
                array_push($arr, $child->id);
        }
    }

    public function categoryLink()
    {
        // ($this->isVIsible() and $this->is_visible) ?
        return  route('shop.product.list', $this);
        //  : "javascript:void(0)";
    }

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\CategoryFactory::new();
    }
}
