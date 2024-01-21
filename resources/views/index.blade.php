<x-app-layout>


    {{-- <x-header-main /> --}}
    {{-- main  --}}
    <div class=" flex flex-col gap-4 ">

        @role('systemAdmin')
        <div class="flex h-48 w-full items-center  rounded-lg bg-gradient-to-br p-6 text-left text-2xl font-bold bg-blue text-black"
            style=" background-position: center;">
            Welcome, {{ Auth::user()->name }}!
    </div>
    <div class="flex flex-col md:flex-row md:space-x-4 max-md:space-y-4 ">
        <div class="w-full md:w-1/3 bg-white p-5 rounded-lg border-2 border-['#E8E8E8'] flex flex-row">
            <div class="w-full md:w-5/6  bg-white rounded-lg ">
                <h1 class="font-bold text-xl ">Active Borrowed</h1>
                <h1 class="font-thin text-xs text-slate-500">No. of Actively Borrowed Items</h1>
            </div>
            <div class="w-full md:w-1/6 justify-between items-center bg-white rounded-lg ">
                <h1 class="font-bold text-xl text-right">{{$totalUnreturnedItems}}</h1>

            </div>

        </div>


        <div class="w-full md:w-1/3 bg-white p-5 rounded-lg border-2 border-['#E8E8E8'] flex flex-row">
            <div class="w-full md:w-5/6  bg-white rounded-lg ">
                <h1 class="font-bold text-xl ">Returned</h1>
                <h1 class="font-thin text-xs text-slate-500">No. of recently returned</h1>
            </div>
            <div class="w-full md:w-1/6 justify-between items-center bg-white rounded-lg ">
                <h1 class="font-bold text-xl text-right">{{$totalReturnedItems}}</h1>

            </div>

        </div>

        <div class="w-full md:w-1/3 bg-white p-5 rounded-lg border-2 border-['#E8E8E8'] flex flex-row">
            <div class="w-full md:w-5/6  bg-white rounded-lg ">
                <h1 class="font-bold text-xl ">Registered Items</h1>
                <h1 class="font-thin text-xs text-slate-500">No. of Sharable Items</h1>
            </div>
            <div class="w-full md:w-1/6 justify-between items-center bg-white rounded-lg ">
                <h1 class="font-bold text-xl text-right">{{$itemMMSU}}</h1>

            </div>

        </div>

    </div>
    {{-- <p>Total Unreturned Items: {{ $totalReturnedItems }}</p> --}}

    {{-- <select name="item_category" id="item_category">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
    </select> --}}

    @endrole


    <div class="flex flex-col md:flex-row space-x-4 ">
        <div class="w-full  bg-white p-5 rounded-lg border-2 border-['#E8E8E8'] flex flex-row">
            <div class="w-full   bg-white rounded-lg ">
                <h1 class="font-bold text-xl ">Recent Logs</h1>
                <table class="min-w-full divide-y divide-gray-200 border-b">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentBorrowedItems as $recentBorrowedItem)
                        <tr>
                            <td class="text-[#585757] py-2 pr-4 whitespace-nowrap">
                                {{$recentBorrowedItem->action}}
                            </td>


                            <td class="text-[#585757] py-2 pr-4 whitespace-nowrap text-right">
                                <div>
                                    {{$recentBorrowedItem->created_at->format('H:i')}}
                                    <br>
                                    <p class="text-sm">{{$recentBorrowedItem->created_at->format('F d, Y')}}</p>
                                </div>
                            </td>


                        </tr>

                        @endforeach
                </table>

            </div>

        </div>
</x-app-layout>
