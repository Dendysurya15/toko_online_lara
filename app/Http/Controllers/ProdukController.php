<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
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
}
