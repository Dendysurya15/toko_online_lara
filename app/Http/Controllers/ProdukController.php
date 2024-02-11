<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //

    public function index()
    {
        return view('admin/index');
    }

    public function edit($id)
    {
        return view('admin/index', ['id' => $id]);
    }

    public function delete($id)
    {

        $query = Produk::find($id);

        $query->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->route('dashboard');
    }
}
