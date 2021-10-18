<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count;
    public $name;
    public $email;

    public function incrementCount()
    {
        $this->count++;
    }

    public function mount($aUser)
    {
        $this->name = $aUser->name;
        $this->email = $aUser->email;
    }

    public function render()
    {
        return view('livewire-component.counter')->extends('livewire.layout.layout')->section('content');
    }
}
