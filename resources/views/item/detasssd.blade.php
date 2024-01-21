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
                                {{-- <x-primary-button id="button"
                                    onclick="this.disabled=true;this.value='Submiting...';this.form.submit();"
                                    class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                                    {{ __('Return Item') }}
                                </x-primary-button> --}}
                                <x-primary-button id="returnButton" onclick="returnItem('store')"
                                    {{-- onclick="this.disabled=true;this.value='Submitting...';this.form.submit();" --}}
                                    class="my-4 flex w-full justify-center bg-[#042558] px-8 py-4">
                                    <span id="button-text">{{ __('Return Item') }}</span>
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>