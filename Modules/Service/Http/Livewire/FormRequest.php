<?php

namespace Modules\Service\Http\Livewire;

use Livewire\Component;
use Modules\Service\Entities\Service;

class FormRequest extends Component
{
    public $name;
    public $mobile;
    public $topic;
    public $desc;

    protected $rules = [
        "name" => ['required', 'max:255'],
        "mobile" => ['required', 'regex:/^(?:0|98|\+98|\+980|0098|098|00980)?(9\d{9})$/u'],
        "topic" => ['required'],
        "desc" => ['max:1024']
    ];
    public function saveData()
    {
        $this->validate();

        Service::create([
            "name" => $this->name,
            "mobile" => $this->mobile,
            "item_id" => $this->topic,
            "message" => $this->desc
        ]);

        session()->flash('message', "درخواست شما با موفقیت ثبت شد . دراسرع وقت با شما تماس حاصل خواهد شد.");
    }

    public function render()
    {
        return view('service::livewire.form-request');
    }
}
