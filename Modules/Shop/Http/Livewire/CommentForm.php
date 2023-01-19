<?php

namespace Modules\Shop\Http\Livewire;

use Livewire\Component;
use Modules\Shop\Entities\Product;

class CommentForm extends Component
{
    public Product $product;

    public $rating, $comment;

    protected $rules = [
        'rating' => ['required', "digits_between:1,5"],
        "comment" => "required|max:255"
    ];

    public function mount($product)
    {
        $this->product = $product->load('comments');
    }

    public function submitComment()
    {
        $this->validate();


        auth()->user()->comments()->create([
            // "parent_id" => $this->replay ? $this->replay->id : 0,
            "rating" => $this->rating,
            "content" => $this->comment,
            "rating" => $this->rating,
            "commentable_id" => $this->product->id,
            "commentable_type" => get_class($this->product)
        ]);

        $this->rating = null;
        $this->comment = null;

        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد و منتظر تایید می باشد.');
    }

    public function render()
    {
        return view('shop::livewire.comment-form');
    }
}
