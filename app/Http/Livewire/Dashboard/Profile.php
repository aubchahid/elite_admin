<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $fullname, $email, $password;


    public function mount()
    {
        $this->fullname = Auth::user()->name;
        $this->email = Auth::user()->email;
    }


    public function save()
    {
        $this->validate(['fullname' => 'required', 'email' => 'required']);

        $user = User::find(Auth::id());
        $user->name = $this->fullname;
        $user->email = $this->email;
        if ($this->password != null) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => "Votre profil a été mis à jour avec succés."]);
    }

    public function render()
    {
        return view('livewire.dashboard.profile')->layout('layouts.dashboard', ['title' => Auth::user()->name]);
    }
}
