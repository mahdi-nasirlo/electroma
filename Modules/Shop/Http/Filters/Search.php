<?Php

namespace Modules\Shop\Http\Filters;

use Closure;
use Illuminate\Support\Facades\Log;

class Search
{
    public $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function handle($request, Closure $next)
    {
        if (!$this->string or $this->string == "") {
            return $next($request);
        }

        return $next($request)->where('name', 'like', '%' . $this->string . '%');
    }
}
