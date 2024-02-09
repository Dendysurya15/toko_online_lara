<?php

namespace App\Livewire;

use App\Models\Produk;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        $products = Produk::with('kategori')->get();

        // dd($products);
        return view('livewire.dashboard', ['products' => $products]);
    }
}
