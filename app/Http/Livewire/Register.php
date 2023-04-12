<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';

    public function render()
    {
        return view('livewire.register')->extends('layouts.app')->section('content');
    }

    protected $rules = [
        'email' =>'required|email|unique:users',
        'password' =>'required|min:8|same:passwordConfirmation',
        'name' =>'required',
    ];


    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function register(){
       $validatedData = $this->validate();

      $user =  User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),

        ]);

        auth()->login($user);
        return redirect('/dashboard');


    }


}
