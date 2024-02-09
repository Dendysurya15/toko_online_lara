<?php

namespace App\Livewire\Admin\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $nama_barang;
    public $pil_kategori;
    public $stok;
    public $harga;
    public bool $successSubmit = false;
    public string $msgSuccess;
    public bool $errorSubmit = false;
    public string $msgError;

    public Produk $product;

    public function render()
    {
        $kat_arr = Kategori::pluck('nama_kategori', 'id')->toArray();
        return view('livewire.admin.produk.index', ['kat_arr' => $kat_arr]);
    }
    public function mount(Produk $product)
    {
        // $this->product = $product;
        // dd($this->product);
        $default = Kategori::first()->id;

        $this->pil_kategori = $default;
    }

    public function save()
    {

        try {
            DB::beginTransaction();

            Produk::create([
                'nama_barang' => $this->nama_barang,
                'jenis_barang' => $this->pil_kategori,
                'stok' => $this->stok,
                'harga' => $this->harga,
            ]);
            DB::commit();
            $this->successSubmit = true;
            $this->msgSuccess = $this->nama_barang;
            $this->reset([
                'nama_barang',
                'pil_kategori',
                'stok',
                'harga',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            // session()->flash('errorSubmit', 'An error occurred while saving the data. ' .  $e->getMessage());
            $this->msgError = 'An error occurred while saving the data: ' . $e->getMessage();
            // Set the error flag
            $this->errorSubmit = true;
        }
    }
}
