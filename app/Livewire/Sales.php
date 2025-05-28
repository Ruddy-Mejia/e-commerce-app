<?php

namespace App\Livewire;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sales extends Component
{
    public $orders;
    public $counters = [];
    public function mount(){
        $this->orders = Order::with('user')->get();
        $this->counters = [
            'pending' => Order::where('status','pending')->count(),
            'completed' => Order::where('status','completed')->count(),
        ];
    }

    public function toogleStatus($id) {
        $order = Order::find($id);
        $order->status = 'completed';
        $order->save();
        $this->dispatch('show-toast', [
            'message' => "Order #" . $id .  " marked as completed",
            'type' => 'success',
        ]);
    }

    public function render()
    {
        return view('livewire.sales')->layout('layouts.app');
    }
}
