<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_searchable',
        'values',
        'type',
    ];

    protected $casts = [
        'values' => 'array'
    ];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'attribute_product',
            'attributes_id',
            'product_id',
        )
            ->withPivot(['value']);
    }

    protected static function newFactory()
    {
        return \Modules\Shop\Database\factories\AttributeFactory::new();
    }
}
