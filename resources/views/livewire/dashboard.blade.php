<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-start-1">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Halaman {{ implode(', ', Auth::user()->getRoleNames()->all()) }}

                    </h2>
                    <p>
                        @if ($successSubmit)
                    <div class="p-4 mb-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        <span class="font-medium"> {{$msgSuccess}}</span>
                    </div>
                    @endif
                    @if ($errorSubmit)
                    <div class="p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <span class="font-medium">{{ $msgError }}</span>
                    </div>
                    @endif
                    </p>
                </div>
                <div class="col-end-6">
                    @if(auth()->user()->can('tambah produk'))
                    <a href="{{route('tambah_produk')}}"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none ">Tambah
                        Produk</a>
                    @endif
                </div>
            </div>
    </header>

    <div
        class="grid {{ auth()->check() && auth()->user()->hasRole('admin') ? 'grid-cols-1' : 'grid-cols-4' }} gap-4 pt-6 p-2">
        <div class="col-span-3">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="mt-2 text-xl font-bold">
                            <h1>
                                List Produk Toko ({{$totalProdukToko}})
                            </h1>
                        </div>
                        <div class="mt-3 grid  gap-x-2 gap-y-8 sm:grid-cols-12">
                            @foreach ($products as $key => $item)
                            <div class="sm:col-span-3 ">
                                <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                                    <div class="p-4 md:p-5">
                                        <h3 class="text-md font-bold text-gray-800 ">
                                            {{$item->nama_barang}} ( {{$item->kategori->nama_kategori}} )
                                        </h3>
                                        <h4 class="text-lg font-bold text-gray-800 ">
                                            Rp{{$item->harga}}
                                        </h4>
                                        <p class="mt-2 text-gray-500 dark:text-gray-400">
                                            Stok Terakhir : {{$item->stok}}
                                        </p>


                                        @if(auth()->user()->can('tambah cart produk'))
                                        <button
                                            class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold @if($item['stok'] == 0) text-gray-500 cursor-not-allowed @elseif(in_array($item->id, $clickedItems)) text-red-500 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 @else text-red-500 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400 @endif"
                                            @if($item['stok']> 0) wire:click="addToCart({{$item}})" @endif>
                                            <span class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                </svg>
                                                @if($item['stok'] == 0)
                                                Sold Out
                                                @elseif(in_array($item->id, $clickedItems))
                                                Remove from Cart
                                                @else
                                                Add To Cart
                                                @endif
                                            </span>
                                        </button>


                                        @endif


                                    </div>
                                    @if(auth()->user()->can('tambah produk'))
                                    <div class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 ">
                                        <p class="mt-1 text-sm text-gray-500 ">
                                            Last updated {{$item->updated_at->diffForHumans()}}
                                        </p>
                                        <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                            href="{{route('edit_produk',['id'=>$item->id])}}">
                                            Edit Data
                                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </a>
                                    </div>
                                    @endif


                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>


                </div>
            </div>
        </div>

        @if(auth()->user()->can('order & checkout produk'))

        <div class="bg-white shadow-sm sm:rounded-lg">

            <div class="p-3">
                <h4>
                    Cart Shooping ({{$countKeranjang}} items)
                </h4>

                <div class="flex flex-col mt-3 ">
                    <div
                        class="h-72 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">

                        <div class=" text-gray-500 dark:text-gray-400">
                            @foreach ($listKeranjang as $key => $item)
                            <ul class="max-w-xs flex flex-col">
                                <li>
                                    <div class="py-2 px-3 mb-1 bg-white border border-gray-200 rounded-lg"
                                        data-hs-input-number>
                                        <div class="w-full flex justify-between items-center gap-x-3">
                                            <div>
                                                <span class="block font-medium text-lg text-gray-800 ">
                                                    {{$item['nama_barang']}}
                                                </span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                    Price : {{$item['harga']}}
                                                </span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                                    Total : {{$totalPerItems[$key]}}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-x-1.5 ">
                                                <button type="button" wire:click="decrementCountPerItemCart({{$key}})"
                                                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                    data-hs-input-number-decrement {{ $incrementPerItems[$key]==1
                                                    ? 'disabled' : '' }}>
                                                    <svg class="flex-shrink-0 w-3.5 h-3.5"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                    </svg>
                                                </button>
                                                <p>{{$incrementPerItems[$key]}}</p>
                                                <button type="button" wire:click="incrementCountPerItemCart({{$key}})"
                                                    class="w-6 h-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                    data-hs-input-number-increment>
                                                    <svg class="flex-shrink-0 w-3.5 h-3.5"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14" />
                                                        <path d="M12 5v14" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div>
                                                <button wire:click="deleteListKeranjang({{$key}}, {{$key}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="red"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">

                    <div class="text-lg">
                        @if ($listKeranjang != null)
                        Rp.{{$total}}
                        @endif

                    </div>
                    <div class="col-end-6">
                        <button type="button" wire:click="checkout"
                            class="py-2 px-3 flex justify-end gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            Checkout
                        </button>
                    </div>

                </div>

            </div>
        </div>
        @endif
    </div>


</div>