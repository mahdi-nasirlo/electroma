<?php

namespace App\Http\Livewire;

use Modules\Shop\Entities\Product;;

use Livewire\Component;
use Modules\Shop\Entities\Product as EntitiesProduct;

class Search extends Component
{
    public $string;

    public $queryString = [
        'string'
    ];

    public function mount()
    {
        // dd(Product::query()->where('name', 'link', '%' . $this->string . '%')->get());
        // return $this->result = "lsdjkfkl";
    }

    public function render()
    {
        $result = EntitiesProduct::query()->where('name', 'like', '%' . $this->string . '%')->get();


        return view('livewire.search', ['result' => $result]);
    }
}
