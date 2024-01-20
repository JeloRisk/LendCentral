
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



 
    <div class="w-full py-5 pl-0 bg-white rounded-lg" x-data="{ modal: false, checkModal: false, item_id: 'asdasd' }">
        <div class="">
            <div class="flex w-full flex-col justify-between px-8">

                <div class="flex flex-row items-center justify-between">
                    <h1 class="font-bold text-xl">Item List</h1>
                    <a href="/create/item" class="px-8 block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2  rounded">
                        Add New
                    </a>
                </div>
            </div>
            
            <table class="w-full mt-4 table-fixed border-spacing-y-2 border-spacing-x-0 text-xs md:text-base divide-gray-200 border sm:rounded-lg">
            

                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-500">
                        <th
                            class=" w-36 px-8 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Asset Tag
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($items as $item)
                    <tr class="">

                        <td class=" w-36 px-8 py-4 whitespace-nowrap">
                            <div class="flex flex-col h-full">
                                <div class="flex w-full flex-col items-start">
                                    <h1 class="text-slate-800 text-lg w">{{ $item->asset_tag }}</h1>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col h-full">
                                <div class="flex w-full flex-col items-start">
                                    <h1 class="text-slate-800 text-lg w">{{ $item->item_name }}</h1>
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
                        
                        <td class="px-8 py-4 whitespace-nowrap">
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
            <div class="flex w-full flex-col gap-1 md:w-[100%] justify-between items-end pt-5 px-8 ">
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


