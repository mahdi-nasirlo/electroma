<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;

class CommentForm extends Component
{
    public $model;
    public $message;
    public $comments;
    public $replay;

    protected $rules = [
        "message" => 'required|min:8',
    ];

    public function mount($model, $replay = null)
    {
        $this->comments = $this->model->comments->where('is_visible', true)->where('parent_id', 0);
        $this->model = $model;

        $this->replay = $replay;
    }

    public function saveComment()
    {
        $this->validate();

        auth()->user()->comments()->create([
            "parent_id" => $this->replay ? $this->replay->id : 0,
            "content" => $this->message,
            "commentable_id" => $this->model->id,
            "commentable_type" => get_class($this->model)
        ]);

        $this->message = null;
        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد و منتظر تایید می باشد.');
    }

    public function render()
    {
        return view('blog::livewire.comment-form');
    }
}
