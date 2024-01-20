    <x-app-layout>
        <script>
            // Get the input element for the 'until_date' field
            const untilDateInput = document.getElementById('to');

            // Get the current date
            const currentDate = new Date();

            // Format the current date as 'YYYY-MM-DD'
            const formattedCurrentDate = currentDate.toISOString().split('T')[0];

            // Set the 'min' attribute of the input field to the current date
            untilDateInput.min = formattedCurrentDate;

        </script>
        <script type="text/javascript">
            function showTime() {
                var date = new Date(),
                    utc = new Date(Date.UTC(
                        date.getFullYear(),
                        date.getMonth(),
                        date.getDate(),
                        date.getHours(),
                        date.getMinutes(),
                        date.getSeconds()
                    ));

                document.getElementById('time').innerHTML = utc.toLocaleTimeString('en-US', {
                    timeZone: 'Asia/Jakarta',
                });
            }

            setInterval(showTime, 1000);

            function f1(objButton) {
                document.getElementById('id-buku').value = objButton.id;
            }

            function prevent(e) {
                e.preventDefault()
                document.getElementById('check-modal').class = "flex";
                setTimeout(() => {
                    document.getElementById('check-modal').class = "hidden";
                }, 5000);

            }


            // $(document).ready(function () {

            //     $('#button').click(function () {
            //         $('#your-submit-button-id').attr('disabled', true);
            //     });

            // });

        </script>


        @if (Session::has('book_borrowed'))
        <script>
            Swal.fire({
                title: 'Successful Borrowing',
                icon: 'success',

                confirmButtonText: 'Back'
            })

        </script>
        @endif

        <div class=" fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm
            md:pl-[20%]">
            <button @click=" open=! open"
                class="flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none md:hidden">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div
                class="ml-4 flex h-full flex-1 flex-row items-center gap-2 overflow-hidden rounded-full border-2 border-slate-300">
                <div class="hidden h-full items-center bg-slate-100 px-4 sm:flex">
                    <h3>All</h3>

                </div>
                <form action="daftar-buku?" class="flex-1">

                    <input type="text" name="search_query"
                        class="flex w-full border-0 bg-transparent outline-none focus:border-0 focus:outline-none"
                        placeholder="Search">

                </form>
                <img src="{{ url('/images/Search.svg') }}" alt="Image" class="mr-4" />
            </div>
            <div
                class="ml-4 hidden h-full flex-row items-center justify-center gap-4 overflow-hidden rounded-full border-2 border-slate-300 px-4 md:flex">
                <div class="flex flex-row items-center">
                    <img src="{{ url('/images/Vector.svg') }}" alt="Image" class="mr-2" />
                    <h3 id="time"></h3>
                </div>
                <div class="flex flex-row items-center">
                    <img src="{{ url('/images/Vector2.svg') }}" alt="Image" class="mr-2" />
                    <h3>{{ date('Y-m-d') }}</h3>
                </div>
            </div>
        </div>
        <div class="w-full pt-24 pl-0 md:pl-[20%]" x-data="{ modal: false, checkModal: false, item_id: 'asdasd' }">
            <div x-data="{ activeTab: 'overview' }">

                <div class="flex flex-col gap-4 px-2 md:px-8">
                    {{-- <a href="/daftar-buku" class="flex flex-row items-center gap-2">
                        <img src="{{ url('/images/back.svg') }}" alt="Image" class="" />
                    <span>Back</span>
                    </a> --}}

                    <a href="javascript:void(0);" onclick="history.back();" class="flex flex-row items-center gap-2">
                        <img src="{{ url('/images/back.svg') }}" alt="Image" class="" />
                        <span>Back</span>
                    </a>

                    <div class="flex flex-col gap-4 md:flex-row md:gap-0">
                        <div class="flex w-full flex-col md:w-[60%]">
                            <div class="flex flex-row gap-4">
                                <img src="{{ $item->cover_url }}" alt="Image" class="w-24 sm:w-40" />
                                <div class="flex w-full flex-col justify-between">
                                    <div class="flex flex-col">
                                        <h1 class="text-lg md:text-2xl">{{ $item->item_name }}</h1>
                                        <h3 class="text-slate-700">Asset Tag : {{ $item->asset_tag }}</h3>


                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold">Status</span>
                                        <span
                                            class="{{ $item->status ? 'bg-[#42BB4E]' : 'bg-slate-400' }} w-fit rounded-md py-1 px-4 text-white">
                                            {{ $item->status ? 'Available' : 'Not Available' }}</span>
                                    </div>
                                </div>
                            </div>



                            <div class="mt-4 flex flex-row gap-8 text-slate-700">

                                {{-- @role('librarian')
                            <form action={{ route('book.destroy', ['book' => $item->id]) }} method="post"
                                style="display: inline;">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="_method" value="delete" />
                                <input type="text" name="item_id" id="item_id" class="hidden" value="{{ $item->id }}">
                                <button type="submit"
                                    class="flex h-full flex-col items-center justify-between text-sm font-bold">
                                    <img src="{{ url('/images/trash.svg') }}" alt="Image" class="h-8"
                                        style="margin-top: 0.05rem; width: 1.4rem" />
                                    Delete
                                </button>
                                </form>
                                @endrole --}}
                            </div>
                        </div>
                        <div class="flex w-full flex-col gap-1 md:w-[40%] justify-between items-center">
                            <!-- Add "justify-between" and "items-center" classes here -->
                            <div class="ml-auto">
                                <!-- Use "ml-auto" to push the content to the top-right -->
                                @if ($item->status)
                                <button @click="name = 'asdasd';modal = !modal" onclick="f1(this)" 
                                {{-- name="pinjam" --}}
                                    id="{{ $item->id }}"
                                    class="w-max rounded-md border border-[#517DAB] py-1 px-2 shadow-md duration-200 hover:scale-105 md:border-2">
                                    Borrow
                                </button>
                                @else
                                <button
                                    class="w-max rounded-md border border-[#ff0606] py-1 px-2 shadow-md duration-200 md:border-2 cursor-not-allowed opacity-60"
                                    disabled>
                                    You cannot borrow
                                </button>
                                {{-- <button @click="name = 'asdasd';modal = !modal" onclick="f1(this)" 
                                class="mt-2 w-max rounded-md border border-[#FFB900] py-1 px-2 shadow-md duration-200 md:border-2">
                                    Return This Item
                                </button> --}}

                                <button @click="modal = 'return'" class="w-full md:w-max rounded-md border border-[#FFB900] py-1 px-2 shadow-md duration-200 md:border-2 mt-2 md:mt-0">
                                    Return This Item
                                </button>
                                @endif
                            </div>

                            {{-- 
                        <h2 class="text-lg text-slate-600">{{ $item->author->name }}</h2>
                            <p class="text-sm text-slate-600">{{ $item->author->biography }}</p>
                            --}}
                        </div>

                    </div>
                    <div class="flex w-full flex-row gap-4">
                        <button @click="activeTab = 'overview'" class="flex flex-1 justify-center border-b-2"
                            :class="{ 'border-[#F27851]': activeTab == 'overview', 'border-slate-400': activeTab != 'overview' }">Borrowed
                            History</button>
                        <button @click="activeTab = 'details'" class="flex flex-1 justify-center border-b-2"
                            :class="{ 'border-[#F27851]': activeTab == 'details', 'border-slate-400': activeTab != 'details' }">Details</button>
                        <button @click="activeTab = 'reviews'" class="flex flex-1 justify-center border-b-2"
                            :class="{ 'border-[#F27851]': activeTab == 'reviews', 'border-slate-400': activeTab != 'reviews' }">Reviews</button>
                    </div>
                    <div class="flex w-full flex-col"
                        :class="{ 'flex': activeTab == 'overview', 'hidden': activeTab != 'overview' }">
                        <!-- Display borrowed history for the specified book -->
                        @if ($borrowedHistory->count() > 0)
                        <h3 class="text-xl font-bold mb-4">Borrowed History</h3>
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Borrowed Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Until Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Return Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($borrowedHistory as $history)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $history->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $history->email }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $history->borrowed_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $history->until_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $history->return_date }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-lg">No borrowing history for this Item.</p>
                        @endif



                    </div>
                    <div class="w-full" :class="{ 'flex': activeTab == 'details', 'hidden': activeTab != 'details' }">
                        Details
                    </div>
                    <div class="w-full" :class="{ 'flex': activeTab == 'reviews', 'hidden': activeTab != 'reviews' }">
                        Reviews
                    </div>
                </div>




            </div>


            <!-- Modal -->
            <div id="check-modal" tabindex="-1" aria-hidden="true"
                class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">

                <div class="fixed h-full w-full bg-slate-800 opacity-50">

                </div>
                <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                    <!-- Modal content -->
                    <div class="relative flex flex-col items-center gap-8 rounded-lg bg-white p-12 shadow">
                        <h2 class="text-xl font-bold">Done</h2>

                        <img src="{{ url('/images/check.svg') }}" alt="Image" class="w-[25%]" />

                        <button @click="modal = ! modal" type="button"
                            class="justify-centerw-full flex rounded-md bg-[#274472] px-4 py-2 text-xl font-bold text-white shadow-md duration-200 hover:scale-105">
                            Back
                        </button>
                    </div>
                </div>

            </div>
            <div x-show="modal === 'return'" id="return-modal" ...>
                <!-- Return modal content goes here ... -->
            </div>
            <!-- Modal -->
            <div :class="{ 'block': modal, 'hidden': !modal }" id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">

                <div class="fixed h-full w-full bg-slate-800 opacity-50">

                </div>
                <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                    <!-- Modal content -->
                    <div class="relative rounded-lg bg-white shadow">
                        <button @click="modal = ! modal" type="button"
                            class="absolute top-3 right-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-hide="authentication-modal">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <form method="POST" onsubmit="return {{$item->status ? 'true' : 'false'}}" action="/lend">
                                @csrf

                                <div class="my-2 text-center">
                                    <h2 class="font-bold">
                                        Fill up
                                    </h2>
                                </div>

                                <div>

                                    <x-text-input id="id-buku" class="mt-1 hidden w-full bg-transparent" type="text"
                                        name="item_id" required />
                                </div>

                                {{-- <div>
                                    <x-input-label class="font-bold" for="from" :value="__('From')" />
                                    <x-text-input id="from" class="mt-1 block w-full bg-transparent" type="date"
                                        
                                        name="borrowed_date" :value="old('from')" required />
                                </div> --}}

                                <div class="mt-4">
                                    <x-input-label class="font-bold" for="to" :value="__('To')" />

                                    <x-text-input id="to" class="mt-1 block w-full bg-transparent" type="date"
                                        name="until_date" required />

                                </div>
                                <div class="mt-4">
                                    <x-input-label class="font-bold" for="nama" :value="__('Name: ')" />

                                    <x-text-input id="nama" class="mt-1 block w-full bg-transparent" type="text" name="name"
                                        required />

                                </div>

                                <div class="mt-4">
                                    <x-input-label class="font-bold" for="Email" :value="__('Email: ')" />

                                    <x-text-input id="Email" class="mt-1 block w-full bg-transparent" type="email"
                                        name="email" required />

                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="flex w-full justify-center">
                                    <x-primary-button id="button"
                                        onclick="this.disabled=true;this.value='Submiting...';this.form.submit();"
                                        class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                                        {{ __('Grant Borrowing') }}
                                    </x-primary-button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
