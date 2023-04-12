<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{

    public $username = '';
    public $birthday = '';
    public $about = '';
    public $saved = false;


    public function mount(){
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
        $this->birthday = auth()->user()->birthday;
        // ->format('m/d/Y');
    }

    public function updated($propertyName){

        if($propertyName !== 'saved'){
            $this->saved = false;
        }
    }

    protected $rules = [
        'username' => 'required|max:24',
        'about' => 'required|max:140',
        'birthday' => 'sometimes',
    ];

    public function save(){

        $this->validate();

        auth()->user()->update([
            'username' => $this->username,
            'about' => $this->about,
        ]);

        $this->saved = true;
    }

    public function closeNotify(){
        $this->saved = false;
    }




    public function render()
    {
        return view('livewire.profile')->extends('layouts.app')->section('content');
    }
}
