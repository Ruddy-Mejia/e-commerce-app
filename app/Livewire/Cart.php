<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $cart = [];

    protected $listeners = ['addToCart'];

    public function addToCart($payload)
    {
        $cart = session()->get('cart', []);

        $response = Http::withoutVerifying()->get("https://dummyjson.com/products/{$payload}");
        if (!$response->ok()) {
            return;
        }
        $product = $response->json();

        if (isset($cart[$payload])) {
            $cart[$payload]['quantity'] += 1;
        } else {
            $cart[$payload] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'price' => $product['price'],
                'thumbnail' => $product['thumbnail'],
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
    }

    public function placeOrder()
    {
        if (empty($this->cart)) {
            return;
        }
        $items = array_values($this->cart);
        Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'items' => json_encode($items),
            'total_price' => collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity'])
        ]);

        session()->forget('cart');
        $this->dispatch('show-toast', [
            'message' => 'Order confirmation completed',
            'type' => 'success',
        ]);
        return redirect()->route('dashboard');
    }

    public function remove($id)
    {
        unset($this->cart[$id]);
        session()->put('cart', $this->cart);
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }


    public function render()
    {
        $this->cart = session()->get('cart', []);
        return view('livewire.cart');
    }
}
