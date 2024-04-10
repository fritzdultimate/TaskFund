<?php

namespace App\Livewire\Misc;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
class MessageResponse extends Component {

    public $response = '';
    public $url = '';
    public $bg = '';
    public $text = '';
    public $btnColor = '';
    public $btnBg = '';
    public $icon = '';
    public $iconColor = '';

    public function render() {
        return view('livewire.misc.message-response');
    }

}
