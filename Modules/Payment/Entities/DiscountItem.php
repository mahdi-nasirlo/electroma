<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Entities\Course;
use Modules\Shop\Entities\Product;

class DiscountItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "percent",
        "expired_at"
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'discount_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, "discount_id");
    }

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\DiscountItemFactory::new();
    }
}
