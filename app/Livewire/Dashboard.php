<?php

namespace App\Livewire;

use App\Models\Produk;
use App\Models\Transaksi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $countKeranjang = 0;
    public $listKeranjang = [];
    public $clickedItems = [];
    public $incrementPerItems = [];
    public $totalPerItems = [];
    public $total = 0;
    public $totalProdukToko = 0;
    public bool $successSubmit = false;
    public bool $successUpdate = false;
    public string $msgSuccess;
    public bool $errorSubmit = false;
    public string $msgError;


    public function incrementCountPerItemCart($id)
    {

        $this->incrementPerItems[$id]++;
        foreach ($this->listKeranjang as $key => $value) {
            if ($key == $id) {
                $this->totalPerItems[$id] = $value['harga'] * $this->incrementPerItems[$id];

                $this->total += $value['harga'];
            }
        }
    }

    public function deleteListKeranjang($id, $idClick)
    {

        unset($this->listKeranjang[$id]);
        unset($this->totalPerItems[$id]);
        unset($this->incrementPerItems[$id]);
        unset($this->clickedItems[$id]);

        $this->listKeranjang = array_values($this->listKeranjang);
        $this->totalPerItems = array_values($this->totalPerItems);
        $this->incrementPerItems = array_values($this->incrementPerItems);
        $this->clickedItems = array_values($this->clickedItems);

        $this->countKeranjang--;
    }

    public function decrementCountPerItemCart($id)
    {
        $this->incrementPerItems[$id]--;
        foreach ($this->listKeranjang as $key => $value) {
            if ($key == $id) {
                $this->totalPerItems[$id] = $value['harga'] / $this->incrementPerItems[$id];

                $this->total -= $value['harga'];
            }
        }
    }
    public function checkout()
    {




        try {
            DB::beginTransaction();
            $list = $this->listKeranjang;

            $transaksi = null;
            foreach ($list as $key => $value) {
                $produk_id = $value['id'];
                $total = $this->totalPerItems[$key];
                $perItem = $this->incrementPerItems[$key]; // Assuming $key corresponds to the item in $totalPerItems
                $transaksi =  Transaksi::create([
                    'user_id' => Auth::user()->id,
                    'produk_id' => $produk_id,
                    'total' => $total,
                    'jumlah' => $perItem,
                    'keterangan' => null,
                    'waktu_transaksi' => now()->timezone('Asia/Jakarta')
                ]);
                Produk::where('id', $produk_id)->decrement('stok', $perItem);
            }
            DB::commit();
            $this->resetCartData();
            $this->successSubmit = true;
            $this->msgSuccess = 'Transaksasi Sukses dilakukan';
        } catch (Exception $e) {
            DB::rollBack();
            // session()->flash('errorSubmit', 'An error occurred while saving the data. ' .  $e->getMessage());
            $this->msgError = 'An error occurred while saving the data: ' . $e->getMessage();
            // Set the error flag
            $this->errorSubmit = true;
        }
    }

    private function resetCartData()
    {
        $this->listKeranjang = [];
        $this->totalPerItems = [];
        $this->incrementPerItems = [];
        $this->countKeranjang = 0;
        $this->total = 0;
        $this->clickedItems = [];
    }

    public function addToCart($products)
    {
        if (in_array($products['id'], $this->clickedItems)) {

            $this->countKeranjang--;

            $key = array_search($products['id'], $this->listKeranjang);
            unset($this->listKeranjang[$key]);
        } else {
            $this->countKeranjang++;
            $this->listKeranjang[] = $products;
            $this->incrementPerItems[] = 1;
            $this->totalPerItems[] = $products['harga'];
            $this->total += $products['harga'];
        }
        if (in_array($products['id'], $this->clickedItems)) {
            $this->clickedItems = array_diff($this->clickedItems, [$products['id']]);
        } else {
            $this->clickedItems[] = $products['id'];
        }

        // if (count($this->listKeranjang) > 2) {
        //     dd($this->listKeranjang);
        // }
    }


    public function render()
    {

        $products = Produk::with('kategori')->get();
        $this->totalProdukToko = count($products);
        return view('livewire.dashboard', ['products' => $products]);
    }
}
