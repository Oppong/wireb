<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';



    protected $rules = [
        'email' =>'required|email',
        'password' =>'required|min:8',
    ];

    public function login(){

        $user = $this->validate();
        if (auth()->attempt($user)) {

            session()->regenerate();
            return redirect('/profile');
        }
        return back()
            ->withInput();
            // ->withErrors();

    }

    public function render()
    {
        return view('livewire.login')->extends('layouts.app')->section('content');
    }
}
