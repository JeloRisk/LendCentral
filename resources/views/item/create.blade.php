<x-fullapp>
    <!-- Use the $title variable to set the page title -->
    <x-slot name="title">
        {{ $title }}
    </x-slot>



    <div class="pt-20 pl-0 max-w-lg mx-auto pb-20">
        {{-- <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
            <!-- Modal content --> --}}
            <a href="{{ route('item.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">
                &larr; Back to Item List
            </a>
        <div class="relative rounded-lg bg-white shadow">

            <div class="px-6 py-6 lg:px-8">
                       <!-- Back Button -->
                    
                <form method="POST" action="/create" onsubmit="prevent()" enctype="multipart/form-data">
                    @csrf

                    <div class="my-2 text-center">
                        <h2 class="font-bold">
                            Add Item
                        </h2>
                    </div>

                    {{-- <div>

                            <x-text-input id="id-buku" class="mt-1 hidden w-full bg-transparent" type="text"
                                name="item_id" required />
                        </div> --}}

                    {{-- <div>
                            <x-input-label class="font-bold" for="from" :value="__('From')" />
                            <x-text-input id="from" class="mt-1 block w-full bg-transparent" type="date"
                                name="borrowed_date" :value="old('from')" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label class="font-bold" for="to" :value="__('To')" />

                            <x-text-input id="to" class="mt-1 block w-full bg-transparent" type="date"
                                name="until_date" required />

                        </div> --}}
                    <div class="mt-4">
                        <x-input-label class="font-bold" for="item_name" :value="__('Item Name: ')" />

                        <x-text-input id="item_name" class="mt-1 block w-full bg-transparent" type="text" i
                            name="item_name" required />

                    </div>

                    {{-- <div class="mt-4">
                        <x-input-label class="font-bold" for="cover_url" :value="__('Cover Url: ')" />

                        <x-text-input id="cover_url" class="mt-1 block w-full bg-transparent" type="text"
                            name="cover_url" required />

                        <x-input-error :messages="$errors->get('cover_url')" class="mt-2" />
                    </div> --}}

                    <div class="mt-4">
                        <x-input-label class="font-bold" for="asset_tag" :value="__('Asset Tag: ')" />

                        <x-text-input id="asset_tag" class="mt-1 block w-full bg-transparent" type="text" name="asset_tag"
                            required />

                        <x-input-error :messages="$errors->get('asset_tag')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="font-bold" for="quantity" :value="__('quantity: ')" />

                        <x-text-input id="quantity" class="mt-1 block w-full bg-transparent" type="text" name="quantity"
                            required />

                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label class="font-bold" for="status" :value="__('status: ')" />
                    
                        <select id="status" name="status" class="mt-1 block w-full bg-transparent" required>
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    

                    <div class="mt-4">
                        <x-input-label class="font-bold" for="status" :value="__('category: ')" />

                        <x-select-input :categories="$categories" class="mt-1 block w-full bg-transparent"
                            name="item_category" id="item_category" />
                    </div>

                    <div class="mt-4">
                        <x-input-label class="font-bold" for="cover_url" :value="__('Image: ')" />

                        {{-- <x-text-input id="product_image" class="mt-1 block w-full bg-transparent" type="text" name="product_image"
                            required /> --}}

                        <input type="file" name="cover_url" id="cover_url" class="mt-1 block w-full bg-transparent" required/>
                    </div>


                    <div class="flex w-full justify-center">
                        <x-primary-button class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                            {{ __('Add Item') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>



















    <!-- Your content here -->
</x-fullapp>
