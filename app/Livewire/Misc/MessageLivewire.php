<?php

namespace App\Livewire\Misc;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
class MessageLivewire extends Component {

    public $payload;

    public function render() {
        return view('livewire.misc.message-livewire');
    }

}
