<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsList extends Component
{
    public $search = '';
    public $selectedCategory = '';
    public $sortPrice = 'asc';

    public function toggleSort()
    {
        $this->sortPrice = $this->sortPrice === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $response = Http::withoutVerifying()->get('https://dummyjson.com/products?limit=100');
        $products = collect($response['products']);

        if ($this->selectedCategory) {
            $products = $products->where('category', $this->selectedCategory);
        }

        if ($this->search) {
            $products = $products->filter(
                fn($product) =>
                str_contains(strtolower($product['title']), strtolower($this->search))
            );
        }

        if ($this->sortPrice === 'asc') {
            $products = $products->sortBy('price')->values();
        } elseif ($this->sortPrice === 'desc') {
            $products = $products->sortByDesc('price')->values();
        }

        $page = request()->get('page', 1);
        $perPage = 12;
        $paginator = new LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $categoriesResponse = Http::withoutVerifying()->get('https://dummyjson.com/products/categories');
        $categories = $categoriesResponse->json();

        return view('livewire.products-list', [
            'products' => $paginator,
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
