<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email, $password;

    public function submit(Request $request)
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $this->email)->first();
        if ($user) {
            $credentials = [
                'email' => strtolower($this->email),
                'password' => $this->password,
            ];
            if (Auth::attempt($credentials, true)) {
                $request->session()->regenerate();
                return redirect('/');
            } else {
                session()->flash('message', "Votre mot de passe est incorrect, veuillez saisir un mot de passe correct.");
            }
        } else {
            session()->flash('message', "Il n'y a aucun utilisateur avec cet e-mail, veuillez vérifier votre e-mail.");
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
