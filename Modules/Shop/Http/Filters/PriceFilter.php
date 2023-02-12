<?Php

namespace Modules\Shop\Http\Filters;

use Closure;

class PriceFilter
{
    public $from;

    public $to;

    public function __construct($from, $to)
    {
        $this->from = $from * 1000;
        $this->to = $to * 1000;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->from and !$this->to) {
            return $next($request);
        }

        return $next($request)->whereBetween('price', [$this->from, $this->to]);
    }
}
