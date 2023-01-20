<?php

namespace Modules\Payment\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Course\Entities\Course;
use Modules\Shop\Entities\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_serial',
        'status',
        'price',
        'user_id',
        'course_id',
        'discount_percent'
    ];

    protected $appends = [
        'price_without_delivery',
        'total_price',
    ];

    public function getTotalPriceAttribute()
    {
        return $this->attributes['price'] - $this->amount_of_discount;
    }

    public function getPriceWithoutDeliveryAttribute()
    {
        return $this->attributes['price'] - env("DELIVERY_PRICE");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'orderable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function canAccessToPayment()
    {
        return $this->status == "unpaid" or !$this->orderHasPayment();
    }

    public function orderHasPayment()
    {
        return $this->payments->isNotEmpty();
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function orderables()
    {
        return $this->morphTo();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    protected static function newFactory()
    {
        return \Modules\Payment\Database\factories\OrderFactory::new();
    }
}
