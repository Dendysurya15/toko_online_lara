<div>

    <div class="grid grid-cols-2 gap-4">
        <div class="col-start-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Halaman {{ implode(', ', Auth::user()->getRoleNames()->all()) }}



            </h2>
            {{$testbro}}
            <button wire:click='testgan'>tambahterus</button>

        </div>
        {{-- <div class="col-end-6   ">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Halaman {{ implode(', ', Auth::user()->getRoleNames()->all()) }}
            </h2>
        </div> --}}

        <div class="col-end-6">
            <div class="hs-tooltip inline-block [--trigger:click] [--placement:left]">
                <button type="button"
                    class="hs-tooltip-toggle p-3 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                    data-hs-overlay="#hs-overlay-right">
                    Cart {{$countKeranjang}}
                </button>
                <div id="hs-overlay-right"
                    class="hs-overlay hs-overlay-open:translate-x-0 hidden translate-x-full fixed top-0 end-0 transition-all duration-300 transform h-full max-w-xs w-full z-[80] bg-white border-s dark:bg-gray-800 dark:border-gray-700"
                    tabindex="-1">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">
                            Cart Shopping {{Auth::user()->name}}
                        </h3>
                        <button type="button"
                            class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            data-hs-overlay="#hs-overlay-right">
                            <span class="sr-only">Close modal</span>
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-4 overflow-auto max-h-[calc(100vh-120px)] relative">
                        <p class="text-gray-800 dark:text-gray-400">
                            <li>

                            </li>
                        </p>
                        <button type="button"
                            class="fixed bottom-4 right-4 p-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            Checkout
                        </button>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>