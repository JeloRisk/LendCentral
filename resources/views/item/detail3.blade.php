    <x-app-layout>
        <script>
            // Display time with interval update
            function showTime() {
                var date = new Date(),
                    phTime = new Date(date.toLocaleString('en-US', {
                        timeZone: 'Asia/Manila'
                    }));

                document.getElementById('time').textContent = phTime.toLocaleTimeString('en-US', {
                    timeZone: 'Asia/Manila',
                });
            }

            setInterval(showTime, 1000);

            // Open modal function
            function openModal(modalId) {
                var modal = document.getElementById(modalId);
                var form = modal.querySelector('form');

                // Reset the form fields
                form.reset();

                modal.classList.add('block');
                modal.classList.remove('hidden');
            }


            // Close modal function
            function closeModal(modalId) {
                document.getElementById(modalId).classList.remove('block');
                document.getElementById(modalId).classList.add('hidden');
            }

            // Handle form submission
            function submitForm() {
                var form = document.getElementById('frmAddEvent');
                var submitButton = document.getElementById(
                    'button'); // Change this to the actual ID of your submit button

                // Disable the submit button to prevent multiple clicks
                submitButton.disabled = true;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.responseType = 'json';

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200 && xhr.response.result === 1) {
                            closeModal('authentication-modal'); // Close the authentication modal
                        } else {
                            // openModal('error-modal'); // Open the error modal
                            alert('Error');
                        }

                        // Enable the submit button after request is complete
                        submitButton.disabled = false;
                    }
                };

                xhr.send(new URLSearchParams(new FormData(form)).toString());
            }

        </script>

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
                    <h3>All
                        @if (session('modalMessage'))
                        {{session('modalMessage')['message']}}
                        @endif
                    </h3>
                </div>
                <form action="/item-list?" class="flex-1">

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

        <!-- Borrow Item button -->
        <div class="w-full pt-24 pl-0 md:pl-[20%]">
            <button onclick="openModal('authentication-modal')" type="button"
                class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                Borrow Item
            </button>
        </div>

        <!-- Other content -->

        <!-- Modal for Borrowing -->
        <!-- Modal for Borrowing -->
        <!-- Modal for Borrowing -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow">
                <button onclick="closeModal('authentication-modal')" type="button"
                    class="absolute top-3 right-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- Close icon SVG path -->
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <form id="frmAddEvent" return false;" method="POST" action="/lend"
                        {{-- action="{{ route('item.store') }} --}} ">
                        @csrf

                        <div class=" my-2 text-center">
                        <h2 class="font-bold">
                            Fill up
                        </h2>
                </div>

                <input type="hidden" id="item_id_modal" name="item_id" value="{{ $item->id }}" />

                <!-- Other input fields -->

                {{-- <div>
                                <x-input-label class="font-bold" for="from" :value="__('From')" />
                                <x-text-input id="from" class="mt-1 block w-full bg-transparent" type="date"
                                    
                                    name="borrowed_date" :value="old('from')" required />
                            </div> --}}

                <div class="mt-4">
                    <x-input-label class="font-bold" for="to" :value="__('To')" />

                    <x-text-input id="to" class="mt-1 block w-full bg-transparent" type="date" name="until_date"
                        required />

                </div>
                <div class="mt-4">
                    <x-input-label class="font-bold" for="nama" :value="__('Name: ')" />

                    <x-text-input id="nama" class="mt-1 block w-full bg-transparent" type="text" name="name" required />

                </div>

                <div class="mt-4">
                    <x-input-label class="font-bold" for="Email" :value="__('Email: ')" />

                    <x-text-input id="Email" class="mt-1 block w-full bg-transparent" type="email" name="email"
                        required />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="flex w-full justify-center">
                    <x-primary-button id="button" onclick="submitForm()"
                        {{-- onclick="this.disabled=true;this.value='Submitting...';this.form.submit();" --}}
                        class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                        {{ __('Grant Borrowing') }}
                    </x-primary-button>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>

        <!-- Display the modal with session message -->
        @if (session('modalMessage'))
        <div x-show="modal.open" id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">

            <div class="fixed h-full w-full bg-slate-800 opacity-50"></div>
            <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow">
                    <button @click="modal = !modal" type="button"
                        class="absolute top-3 right-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Close icon SVG path -->
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <div class="relative flex flex-col items-center gap-8 rounded-lg bg-white p-12 shadow">
                            @if (session('modalMessage')['status'] === 'success')
                            <h2 class="text-xl font-bold text-green-500">Success</h2>
                            @elseif (session('modalMessage')['status'] === 'error')
                            <h2 class="text-xl font-bold text-red-500">Error</h2>
                            @endif

                            <p>{{ session('modalMessage')['message'] }}</p>

                            <button @click="modal = !modal" type="button"
                                class="justify-center w-full flex rounded-md bg-[#274472] px-4 py-2 text-xl font-bold text-white shadow-md duration-200 hover:scale-105">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Other content -->
        {{-- <script></script>
        <script>
            function submitForm() {
                // alert("Hello");
                submitButton.attr('disabled', true);

                var form = $('#frmAddEvent');

                $.post(
                    form.attr('action'),
                    form.serialize(),
                    function (response) {
                        if (response.result != 1) {
                            swal({
                                title: 'Error',
                                text: response.reason,
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#DD6B55',
                                confirmButtonText: 'OK',
                                closeOnConfirm: true,
                            });
                        } else {
                            swal({
                                    title: 'Success',
                                    text: response.reason,
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#00a65a',
                                    confirmButtonText: 'OK',
                                    closeOnConfirm: true,
                                },
                                function () {
                                    // Reload the modal content or perform other actions
                                });

                            // Reload DataTable or other related operations
                        }
                    },
                    'json'
                );
            }

        </script> --}}
    </x-app-layout>
