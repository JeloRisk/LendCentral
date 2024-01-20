<x-app-layout>
    <script>


        const modal = document.getElementById('frmAddEvent');
        // });
        let close =()=>{   
            var allInputs = document.querySelectorAll('input');
         allInputs.forEach(singleInput => singleInput.value = '');modal.reset();
        }

        function clearInputFields() {
        const inputFields = modal.querySelectorAll('input');
        inputFields.forEach(input => {
            input.value = '';
        });
    }

    function hasUserInput() {
        // const inputFields = modal.querySelectorAll('input');
        return true;
        // return Array.from(inputFields).some(input => input.value !== '');
    }
    
   
    
    </script>
    
    
    
    <script>
        
        // Handle form submission
        function submitForm() {
            var form = document.getElementById('frmAddEvent');
            var submitButton = document.getElementById('submitButton');
            var buttonText = document.getElementById('button-text');

            submitButton.disabled = true;
            buttonText.textContent = 'Submitting...';

            var httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', form.action, true);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.responseType = 'json';

            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {

                        // closeModal('authentication-modal');
                        alert(httpRequest.response.reason);
                        location.reload();
                    } else {

                        alert("Error : " + httpRequest.response.reason);
                        // closeModal('authentication-modal');
                        buttonText.textContent = "{{ __('Grant Borrowing ') }}";
                    }

                    submitButton.disabled = false;
                    buttonText.textContent = "{{ __('Grant Borrowing ') }}";
                }
            };

            httpRequest.send(new URLSearchParams(new FormData(form)).toString());
        }

    </script>



    <div class="w-full pt-10 pl-0 bg-white rounded-lg" x-data="{ modal: false, returnModal: false, item_id: 'asdasd' }">
        <div x-data="{ activeTab: 'overview' }">

            <div class="flex flex-col gap-4 px-8">

                <a href="/item-list" {{-- href="javascript:void(0);" onclick="history.back();"  --}}
                    class="flex flex-row items-center gap-2">
                    <img src="{{ url('/images/back.svg') }}" alt="Image" class="" />
                    <span>To the Items </span>
                </a>

                <!-- Item details -->
                <div class="flex flex-col gap-4 md:flex-row md:gap-0">
                    <div class="flex w-full flex-row md:w-[60%]">
                        <!-- Item name and asset tag -->
                 

                        <div class="flex flex-row gap-4">
                            <img src="{{ url('/images/' . $item->cover_url)}}" class=" inset-0 object-cover w-[12rem] h-[12rem]" alt="">
                            <div class="flex w-full flex-col align-bottom">
                                <div class="flex flex-col">
                                    <h1 class="text-lg md:text-3xl">{{ $item->item_name }}</h1>
                                    <h3 class="text-slate-700">sku:: {{ $item->asset_tag }}</h3>
                    
                                </div>
          
                                <div class="flex items-center">
                                    <div class="{{ $item->status ? 'bg-[#117D2C]' : 'bg-red-600' }} h-3 w-3 rounded-full mr-2"></div>
                                    <span class="{{ $item->status ? 'text-green-600' : 'text-red-600' }} text-s">
                                        {{ $item->status ? 'Available' : 'Borrowed' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End of Item name and asset tag -->
                        <div class="mt-4 flex flex-row gap-8 text-slate-700">
                        </div>
                    </div>
      

                    <!-- Borrow and Return buttons section -->
                    <div class="flex w-full flex-col gap-1 md:w-[40%] justify-between items-center">
                        <div class="ml-auto">
                            @if ($item->status)
                            <!-- Borrow button -->
                            <button @click="name = 'asdasd';modal = !modal" onclick="f1(this)" id="{{ $item->id }}"
                                class="w-max rounded-md border border-[#517DAB] py-1 px-2 shadow-md duration-200 hover:scale-105 md:border-2">
                                Borrow
                            </button>
                            @else
                            <!-- Return button -->
                            <button @click="returnModal = true"
                                class="mt-2 w-max rounded-md border border-[#FFB900] py-1 px-2 shadow-md duration-200 md:border-2">
                                Return This Item
                            </button>
                            @endif
                        </div>
                    </div>
                    <!-- End of Borrow and Return buttons section -->


                </div>
                <!-- End of Item details -->


                <div class="flex w-full flex-row gap-4">
                    <button @click="activeTab = 'overview'" class="flex flex-1 justify-center border-b-2"
                        :class="{ 'border-[#F27851]': activeTab == 'overview', 'border-slate-400': activeTab != 'overview' }">
                    </button>

                </div>


                <!-- Borrowed History section -->
                <div class="flex w-full flex-col"
                    :class="{ 'flex': activeTab == 'overview', 'hidden': activeTab != 'overview' }">

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
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Remarks
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($borrowedHistory as $history)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">


                                        <div class="flex flex-col h-full">
                                            <div class="flex w-full flex-col items-start">
                                                <h1 class="text-lg w"> {{ $history->name }}</h1>

                                                <h3 class="text-slate-500 text-xs mb-2"> {{ $history->email }}</h3>

                                            </div>
                                        </div>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="truncate">
                                            {{ $history->remarks }}
                                        </div>
                                        @if (strlen($history->remarks) > 50)

                                        <button class="text-blue-500 hover:underline"
                                            onclick="toggleRemarks({{ $history->id }})">
                                            Read More
                                        </button>
                                        <div id="remarks{{ $history->id }}" class="hidden">
                                            {{ $history->remarks }}
                                            <button class="text-blue-500 hover:underline"
                                                onclick="toggleRemarks({{ $history->id }})">
                                                Read Less
                                            </button>
                                        </div>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <img src="{{ url('/images/aa.png') }}" class="h-24 w-24" alt="">
                    <p class="text-lg">No borrowing history for this Item.</p>

                    @endif



                </div>
                <!-- Borrowed History section -->

            </div>




        </div>

        <!-- Modal for Return -->
        <div :class="{ 'block': returnModal, 'hidden': !returnModal  }" id="authentication-modal" tabindex="-1"
            aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
            <div class="fixed h-full w-full bg-slate-800 opacity-50">

            </div>
            <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow">
                    <button @click="returnModal = !returnModal" type="button"
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
                        <form method="POST" onsubmit="return {{$item->status ? 'true' : 'false'}}"
                            action="/item-return">
                            @csrf
                            @method('put')
                            {{-- @method('PATCH') --}}


                            <div class="my-2 text-center">
                                <h2 class="font-bold">
                                    Return Item
                                </h2>
                            </div>

                            <div class="mt-4">
                                <x-input-label class="font-bold" for="asset_tag" :value="__('Asset Tag: ')" />
                                <x-text-input id="asset_tag"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="text" name="asset_tag" :value="$item->asset_tag" readonly required />
                            </div>

                            <div class="mt-4">
                                <x-input-label class="font-bold" for="returner_name" :value="__('Returner Name: ')" />
                                <x-text-input id="returner_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="text" name="returner_name" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label class="font-bold" for="remarks" :value="__('Remarks: ')" />
                                <textarea id="remarks"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    name="remarks" rows="4" required></textarea>
                            </div>

                            <div class="flex w-full justify-center">
                                <x-primary-button id="button"
                                    onclick="this.disabled=true;this.value='Submiting...';this.form.submit();"
                                    class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                                    {{ __('Return Item') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal for Borrowing -->
        <div :class="{ 'block': modal, 'hidden': !modal  }" id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
            <div class="fixed h-full w-full bg-slate-800 opacity-50">

            </div>
            <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow">
                    <button   @click="modal = !modal, close()" type="button"
                        class="absolute top-3 right-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400  hover:bg-gray-200 hover:text-gray-900 dark:hover:text-black"
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
                        <form id="frmAddEvent" method="POST" action="/item/lend">
                            @csrf

                            <div class="my-2">
                                <h3 class="mb-4 text-xl font-medium text-gray-900">Borrowing Form</h3>
                            </div>

                            <div>

                                <x-text-input id="item_id_modal" class="mt-1 hidden w-full bg-transparent" type="text"
                                    name="item_id" value="{{ $item->id }}" required />
                            </div>


                            <div class="mt-4">
                                <x-input-label class="block mb-2 text-sm font-medium text-gray-900" for="to"
                                    :value="__('To')" />

                                <x-text-input id="to"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="date" name="until_date" required />

                            </div>
                            <div class="mt-4">
                                <x-input-label class="font-bold" for="nama" :value="__('Name: ')" />

                                <x-text-input id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="text" name="name" required />

                            </div>

                            <div class="mt-4">
                                <x-input-label class="font-bold" for="Email" :value="__('Email: ')" />

                                <x-text-input id="Email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    type="email" name="email" required />


                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="flex w-full justify-center">
                                <x-primary-button id="submitButton" onclick="submitForm() "
                                    {{-- onclick="this.disabled=true;this.value='Submitting...';this.form.submit();" --}}
                                    class="my-4 flex w-full justify-center bg-[#042558] px-8 py-4">
                                    <span id="button-text">{{ __('Grant Borrowing') }}</span>
                                </x-primary-button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Returning -->
        <div x-show="returnModal" id="return-modal" tabindex="-1" aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
            <div class="fixed h-full w-full bg-slate-800 opacity-50"></div>
            <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                <div class="relative flex flex-col items-center gap-8 rounded-lg bg-white p-12 shadow">
                    <h2 class="text-xl font-bold">Return Item</h2>

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

        </div>
        <!-- Modal -->
        <div x-show="modal" id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">

        </div>
    </div>
</x-app-layout>
