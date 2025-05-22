<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $chartData, $advice;
    public $imageUrl;
    public $orders;

    public function loadNatureImage()
    {
        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => 'vsWERpbvwHhKOXmJ6n04wHFsL6P3dr6tO8nWMGRktxop4ts0mKBEBZJQ',
        ])->get('https://api.pexels.com/v1/search', [
            'query' => 'nature wallpapers',
            'per_page' => 20,
            'page' => rand(1, 50),
        ]);

        $photos = $response->json('photos');
        $random = $photos[array_rand($photos)];
        $this->imageUrl = $random['src']['large'] ?? null;
    }

    public function mount()
    {
        $this->loadNatureImage();
        $this->orders = Order::where('user_id', Auth::id())->latest()->get();
    }
    public function render()
    {
        $response = Http::withoutVerifying()->get('https://api.adviceslip.com/advice');
        $this->advice = $response->json()['slip']['advice'];

        $ordersData = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->get();

        $months = [];
        $totals = [];

        foreach ($ordersData as $order) {
            $months[] = Carbon::create()->month($order->month)->format('F');
            $totals[] = floatval($order->total);
        }

        $this->chartData = [
            'months' => $months,
            'totals' => $totals
        ];
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
