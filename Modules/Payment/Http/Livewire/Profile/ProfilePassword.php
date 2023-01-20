<?php

namespace Modules\Payment\Http\Livewire\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfilePassword extends Component
{
    public $password;
    public $newPassword;
    public $confirmationPassword;

    protected $rules = [
        "password" => ["required", "min:8"],
        "newPassword" => ["required", "min:8", "max:12"],
        "confirmationPassword" => ["required", "min:8", "same:newPassword"]
    ];

    public function savePassword()
    {
        $this->validate();

        if (Hash::check($this->password, auth()->user()->password)) {
            auth()->user()->update(
                ['password' => Hash::make($this->newPassword)]
            );

            session()->flash('message', "تغییرات با موفقیت ثبت شد .");
        } else
            session()->flash('error', "گذرواژه شما نامعتبر میباشد .");
    }

    public function render()
    {
        return view('payment::livewire.profile.profile-password');
    }
}
