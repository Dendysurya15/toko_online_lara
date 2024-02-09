<div>
    @if(auth()->user()->can('tambah produk'))
    <a href="{{route('tambah_produk')}}"
        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Tambah
        Produk</a>
    @endif

    <div class="mt-4">{{ __("List Produk") }}</div>
    <div class="mt-5 grid  gap-x-6 gap-y-8 sm:grid-cols-12">

        @foreach ($products as $item)
        <div class="sm:col-span-3 ">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl">
                <div class="p-4 md:p-5">
                    <h3 class="text-lg font-bold text-gray-800 ">
                        {{$item->nama_barang}} ( {{$item->kategori->nama_kategori}} )
                    </h3>
                    <h4 class="text-lg font-bold text-gray-800 ">
                        Rp{{$item->harga}}
                    </h4>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        Stok Terakhir : {{$item->stok}}
                    </p>
                </div>
                @if(auth()->user()->can('tambah produk'))
                <div class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 ">
                    <p class="mt-1 text-sm text-gray-500 ">
                        Last updated {{$item->updated_at->diffForHumans()}}
                    </p>
                    <a class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="{{route('edit_produk',['id'=>$item->id])}}">
                        Edit Data
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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