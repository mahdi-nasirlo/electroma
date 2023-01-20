<?php

namespace Modules\Payment\Http\Livewire\Profile;

use Livewire\Component;

class ProfileInfo extends Component
{
    public $name;
    public $email;

    protected $rules = [
        "name" => ['required', 'max:125'],
        "email" => ['required', 'email'],
    ];

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }
    public function saveInfo()
    {
        $this->validate();

        auth()->user()->update([
            "name" => $this->name,
            "email" => $this->email
        ]);

        session()->flash('message', "اطلاعات شما با موفقیت بروزرسانی شد.");
    }

    public function render()
    {
        return view('payment::livewire.profile.profile-info');
    }
}
