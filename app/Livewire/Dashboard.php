<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $chartData, $advice, $joke;
    public $imageUrl;
    public $orders;
    public $mostSoldData = [], $usersPerMonthData = [], $ordersStatus = [];

    public string $temperature = '';
    public string $condition = '';
    public string $icon = '';

    public function mount()
    {
        $this->loadNatureImage();
        $this->mostSold();
        $this->monthlySales();
        $this->getAdvice();
        $this->getUsersPerMonth();
        $this->getJoke();
        $this->loadWeather();
        $this->orders = Order::where('user_id', Auth::id())->latest();
        $this->ordersStatus = [
            'Pending' => $this->orders->get()->where('status', 'pending')->count(),
            'Processed' => $this->orders->get()->where('status', 'processed')->count(),
            'Completed' => $this->orders->get()->where('status', 'completed')->count(),
        ];
        $this->orders = $this->orders->limit(3)->get();
    }

    public function loadWeather()
    {
        $url = "https://api.weatherapi.com/v1/current.json?key=ec98bb61f42e4b6088433153252205&q=calama&aqi=no";
        try {
            $response = Http::withoutVerifying()->get($url);
            if ($response->successful()) {
                $data = $response->json();
                $this->temperature = $data['current']['temp_c'] . ' °C';
                $this->condition = $data['current']['condition']['text'];
                $this->icon = $data['current']['condition']['icon'];
            } else {
                $this->temperature = 'Unavailable';
                $this->condition = 'Error: ' . $response->status();
            }
        } catch (\Exception $e) {
            $this->temperature = 'Unavailable';
            $this->condition = 'Connection error';
        }
    }

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

    private function getJoke()
    {
        $response = Http::withoutVerifying()->get('https://v2.jokeapi.dev/joke/Any?type=single');
        $this->joke = $response->json()['joke'];
    }

    private function monthlySales()
    {
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
    }

    private function mostSold()
    {
        $orders = Order::all();
        $totals = [];

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                if (!isset($totals[$item['title']])) {
                    $totals[$item['title']] = 0;
                }
                $totals[$item['title']] += $item['quantity'];
            }
        }

        arsort($totals);
        $this->mostSoldData = [
            'labels' => array_keys($totals),
            'data' => array_values($totals),
        ];
    }
    private function getUsersPerMonth()
    {
        $users = User::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $this->usersPerMonthData = [
            'labels' => $users->pluck('month'),
            'data' => $users->pluck('count'),
        ];
    }

    private function getAdvice()
    {
        $response = Http::withoutVerifying()->get('https://api.adviceslip.com/advice');
        $this->advice = $response->json()['slip']['advice'];
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
