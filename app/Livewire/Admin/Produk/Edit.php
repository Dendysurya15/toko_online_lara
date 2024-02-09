<?php

namespace App\Livewire\Admin\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Livewire\Forms\PostForm;

class Edit extends Component
{
    public $product;
    public $nama_barang;
    public $pil_kategori;
    public $stok;
    public $harga;
    public $id;
    public $editMode = False;
    public $titlePage;
    public bool $successSubmit = false;
    public bool $successUpdate = false;
    public string $msgSuccess;
    public bool $errorSubmit = false;
    public string $msgError;

    public function mount()
    {
        $default = Kategori::first()->id;

        $this->pil_kategori = $default;
    }
    public function render()
    {
        $this->titlePage = $this->id == null ? 'Tambah' : 'Edit';


        if ($this->id != null) {
            $obj = Produk::find($this->id);
            $this->nama_barang = $obj->nama_barang;
            $this->pil_kategori = $obj->jenis_barang;
            $this->stok = $obj->stok;
            $this->harga = $obj->harga;
        }

        $kat_arr = Kategori::pluck('nama_kategori', 'id')->toArray();
        return view('livewire.admin.produk.edit', ['id' => $this->id, 'kat_arr' => $kat_arr]);
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

    public function update(Produk $product)
    {
        try {
            DB::beginTransaction();

            $product->update([
                'nama_barang' => $this->nama_barang,
                'jenis_barang' => $this->pil_kategori,
                'stok' => $this->stok,
                'harga' => $this->harga,
            ]);
            DB::commit();
            $this->successUpdate = true;
            $this->msgSuccess = $product->id;
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
