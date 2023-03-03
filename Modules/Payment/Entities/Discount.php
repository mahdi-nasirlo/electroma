<?php

namespace Modules\Payment\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Entities\Course;
use Modules\Shop\Entities\Category;
use Modules\Shop\Entities\Product;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'mobiles',
        'discount_value',
        "expired_at",
        "type",
        "is_delivery_free",
        "exception_product_category_id",
        "min_order_value"
    ];

    protected $casts = [
        'mobiles' => 'array'
    ];

    public function discountCategories()
    {
        return $this->belongsToMany(Category::class, "category_discount", "discount_id", "category_id");
    }

    public function discountUsers()
    {
        return $this->belongsToMany(User::class, "discount_user", "discount_id", "user_id");
    }

    public function discountProducts()
    {
        return $this->belongsToMany(Product::class, "discount_product", "discount_id", "product_id");
    }

    public function discountCourses()
    {
        return $this->belongsToMany(Course::class, "course_discount", "discount_id", "course_id");
    }

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\DiscountFactory::new();
    }
}
