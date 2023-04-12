<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{

    public $name = ' this is me learning ';

    public $greeting = [];
    public $plus;


    // this runs at the beginning when livewire component opens for the first time and it  runs only once
    // hence the first request will run mount
    public function mount($plus){
        $this->plus = $plus;
    }

    //it runs at the beginning of every subsequent request that the livewire componenet makes
    // all subsequent request will run the hydrate method
    public function hydrate(){

    }


    // updated method will run anytime you update a public property
    public function updated(){
        $this->name = strtoupper($this->name);
    }


    // this runs before the value is really updated
    public function updating(){}




    public function render()
    {
        return view('livewire.hello-world');
    }
}


// you can store eloquent models or eloquent collections as public properties in livewire
