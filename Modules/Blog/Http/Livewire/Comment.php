<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;

class Comment extends Component
{
    public $model;
    public $message;
    public $comments;

    public function mount($model)
    {
        $this->comments = $this->model->comments->where('is_visible', true)->where('parent_id', 0);
        $this->model = $model;
    }

    public function render()
    {
        return view('blog::livewire.comment');
    }
}
