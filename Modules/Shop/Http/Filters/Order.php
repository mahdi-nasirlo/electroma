<?Php

namespace Modules\Shop\Http\Filters;

use App\Models\Shop\Product;
use Closure;
use Illuminate\Support\Facades\Log;

class Order
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function handle($request, Closure $next)
    {
        $orders = ['priceDEC', "priceASC", "rating", "popular", "last"];

        if (!in_array($this->order, $orders)) {
            return $next($request);
        }

        switch ($this->order) {
            case 'last':
                return $next($request)->latest();
                break;

            case 'priceASC':
                return $next($request)->orderBy('price', 'asc');
                break;

            case 'priceDEC':
                return $next($request)->orderBy('price', 'desc');
                break;

            case 'popular':
                return $next($request)->withCount('orders')
                    ->orderBy('orders_count', 'DESC');
                break;

            case 'rating':
                return $next($request)->withCount('comments')
                    ->orderBy('comments_count', 'DESC');
                break;

            default:
                return $next($request);
                break;
        }

        // return $next($request)->where('name', 'like', '%' . $this->string . '%');
    }
}
