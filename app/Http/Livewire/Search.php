<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Modules\Shop\Entities\Product as EntitiesProduct;

class Search extends Component
{
    public $string;

    public $queryString = [
        'string'
    ];

    public function render(): View
    {
        $result = [];

        if ($this->string) $result = EntitiesProduct::query()->where('name', 'like', '%' . $this->string . '%')->get();

        return view('livewire.search', ['result' => $result]);
    }
}
