
<x-app-layout>
    {{-- <x-nav :data="$array" /> --}}
    

    <script>
        function f1(objButton) {
            document.getElementById('id-buku').value = objButton.id;
        }

    </script>

    <!-- Inside your <script> tag -->
    <script>
        function prevent(e) {
            e.preventDefault();
            const form = document.getElementById('itemForm');
            const submitButton = form.querySelector('button[type="submit"]');

            document.getElementById('check-modal').classList.add("flex"); // Use classList.add() instead of .class
            setTimeout(() => {
                document.getElementById('check-modal').classList.remove("flex"); // Use classList.remove()
            }, 5000);

            // Disable the submit button
            submitButton.disabled = true;

            // Simulate form submission (Replace with your actual form submission logic)
            setTimeout(() => {
                // Re-enable the submit button after the form is processed
                submitButton.disabled = false;
            }, 1000);
        }

    </script>
<x-header-main :search-query="$jquery ?? ' '" />


 
    <div class="w-full pt-24 pl-0 " x-data="{ modal: false, checkModal: false, item_id: 'asdasd' }">
        <div class="">
            <div class="flex w-full flex-col gap-1 md:w-[100%] justify-between items-end px-2 md:px-4 ">
                <!-- Add "justify-between" and "items-center" classes here -->
                <div class="flex flex-row items-end gap-2">
                    <!-- Use "ml-auto" to push the content to the top-right -->
                    {{-- @if ($item->status) --}}
                    {{-- <button @click="name = 'asdasd';modal = !modal" onclick="f1(this)" name="pinjam"
                        class="w-max rounded-md border border-[#517DAB] py-1 px-2 shadow-md duration-200 hover:scale-105 md:border-2">
                        Add Item
                    </button> --}}

                    <a href="/create/item" class="block py-2 pr-4 pl-3">Add New</a>
                    {{-- @else --}}
                    {{-- <button
                    class="w-max rounded-md border border-[#ff0606] py-1 px-2 shadow-md duration-200 md:border-2 cursor-not-allowed opacity-60"
                    disabled>
                    You cannot borrow
                </button> --}}
                    {{-- @endif --}}
                </div>

                {{-- 
    <h2 class="text-lg text-slate-600">{{ $item->author->name }}</h2>
                <p class="text-sm text-slate-600">{{ $item->author->biography }}</p>
                --}}
            </div>
            <table
                class="w-full table-fixed border-separate border-spacing-y-2 border-spacing-x-0 px-2 text-xs md:border-spacing-x-0 md:px-4 md:text-base">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class=" w-36 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Asset Tag
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($items as $item)
                    <tr class="h-16 border">

                        <td class="w-36 px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col h-full">
                                <div class="flex w-full flex-col items-start">
                                    <h1 class="text-lg w">{{ $item->asset_tag }}</h1>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col h-full">
                                <div class="flex w-full flex-col items-start">
                                    <h1 class="text-lg w">{{ $item->item_name }}</h1>
                                    @foreach ($item->categories as $category)
                                    <h3 class="text-slate-500 text-xs mb-2">{{ $category->name }}</h3>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="{{ $item->status ? 'bg-[#117D2C]' : 'bg-red-600' }} h-3 w-3 rounded-full mr-2"></div>
                                <span class="{{ $item->status ? 'text-green-600' : 'text-red-600' }} text-s">
                                    {{ $item->status ? 'Available' : 'Borrowed' }}
                                </span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex w-full flex-col items-end">
                                <a href="/item/{{ $item->id }}"
                                    class="w-auto rounded-md border border-[#194981] py-1 px-2 shadow-md md:border-2">
                                    View
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex w-full flex-col gap-1 md:w-[100%] justify-between items-end px-2 md:px-4 ">
                <div class="flex flex-row items-end gap-2">

                    <div class="flex justify-end space-x-2">
                        {{ $items->links() }}
                    </div>
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

        <!-- Modal -->


</x-app-layout>


