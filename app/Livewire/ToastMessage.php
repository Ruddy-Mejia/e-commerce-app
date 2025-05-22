<?php

namespace App\Livewire;

use Livewire\Component;

class ToastMessage extends Component
{
    public $message = '';
    public $type = '';

    protected $listeners = ['show-toast' => 'showToast'];

    public function showToast($data)
    {
        $this->message = $data['message'];
        $this->type = $data['type'];
    }

    public function render()
    {
        return view('livewire.toast-message');
    }
}
