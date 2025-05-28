<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Component
{
    public $orders;
    public $counters = [];
    public function mount(){
        $this->orders = Order::where('user_id', Auth::id())->get();
        $this->counters = [
            'pending' => Order::where('user_id', Auth::id())->where('status','pending')->count(),
            'completed' => Order::where('user_id', Auth::id())->where('status','completed')->count(),
        ];
    }
    public function render()
    {
        return view('livewire.order-history')->layout('layouts.app');
    }
}
