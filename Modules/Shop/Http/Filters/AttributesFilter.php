<?Php

namespace Modules\Shop\Http\Filters;

use Closure;

class AttributesFilter
{
    public $attributes;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle($request, Closure $next)
    {
        if (empty($this->attributes)) {
            return $next($request);
        }

        // $attributes =  collect($this->attributes)
        //     ->keyBy(function ($item, $key) {
        //         return explode(".", $item)[1];
        //     })->transform(function ($item) {
        //         return explode(".", $item)[0];
        //     });


        return $next($request)->whereHas('attributes', function ($query) {
            $attributes = collect($this->attributes)->transform(
                function ($item) {
                    return ['name' => explode(".", $item)[1], 'value' => explode(".", $item)[0]];
                }
            );
            $query->whereIn('name', $attributes->pluck('name'))->whereIn('value', $attributes->pluck('value'));
        });
    }
}
