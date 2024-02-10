<div>
    <form wire:submit="{{ $editMode ? 'update('. $id .')' : 'save' }}">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Form {{$titlePage}} Barang</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Perlu diperhatikan untuk melakukan
                    pengisian data dengan
                    benar.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Nama
                            Barang</label>
                        <div class="mt-2">
                            <input type="text" wire:model="nama_barang" id="" autocomplete=""
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">

                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Kategori
                            Barang</label>
                        <div class="mt-2">
                            <select id="" wire:model="pil_kategori" autocomplete=""
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600  sm:text-sm sm:leading-6">

                                @foreach ($kat_arr as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class=" sm:col-span-1">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Harga
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="harga" id="" autocomplete=""
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">Stok
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="stok" id="" autocomplete=""
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            {{-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> --}}
            <button type="submit" wire:click="refreshComponent"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>

        @if ($successSubmit)
        <div class="p-4 mb-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            Record <span class="font-medium"> {{$msgSuccess}}</span> berhasil ditambahkan
        </div>
        @endif

        @if ($successUpdate)
        <div class="p-4 mb-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            Record dengan id <span class="font-medium"> {{$msgSuccess}}</span> berhasil diupdate
        </div>
        @endif

        @if ($errorSubmit)
        <div class="p-4 mb-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">{{ $msgError }}</span>
        </div>
        @endif
    </form>
</div>