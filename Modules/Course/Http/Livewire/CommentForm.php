<?php

namespace Modules\Course\Http\Livewire;

use Livewire\Component;
use Modules\Course\Entities\Course;

class CommentForm extends Component
{
    public Course $course;

    public  $comment;

    protected $rules = [
        "comment" => "required|max:255"
    ];

    public function mount($course)
    {
        $this->course = $course;
    }

    public function submitComment()
    {
        $this->validate();


        auth()->user()->comments()->create([
            // "parent_id" => $this->replay ? $this->replay->id : 0,
            "content" => $this->comment,
            "commentable_id" => $this->course->id,
            "commentable_type" => get_class($this->course)
        ]);

        $this->comment = null;

        session()->flash('message', 'دیدگاه شما با موفقیت ثبت شد و منتظر تایید می باشد.');
    }

    public function render()
    {
        return view('course::livewire.comment-form');
    }
}
