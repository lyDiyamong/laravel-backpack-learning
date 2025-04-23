<?php

namespace Mong\BackpackTest\Livewire;

use Livewire\Component;

class Profile extends Component
{

    public $name;

    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('backpack-test::livewire.profile');
    }
}
