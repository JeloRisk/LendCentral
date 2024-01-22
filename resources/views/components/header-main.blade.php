{{-- <div class=" fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm
"> --}}
<div class="ml-4 flex h-[2rem] w-[40rem] flex-row items-center">
    <form action="/item-list?" class="flex-1 w-full relative">
        <input type="text" name="search_query"
            class="h-[2rem] flex w-full overflow-hidden rounded-lg border-[1px] focus:ring-0 focus:border-slate-400 focus:text-[#9f9f9f] bg-transparent p-5 text-slate-500"
            value="{{ $searchQuery ?? '' }}"
            placeholder="{{ __('Item Search') }}">
        <img src="{{ url('/icons/Search.svg') }}" alt="Search Icon" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-5 w-5" />
    </form>
</div>



    {{-- <div
        class="ml-4 hidden h-full flex-row items-center justify-center gap-4 overflow-hidden rounded-lg border-2 border-slate-200 px-4 md:flex">
     
        <div class="flex flex-row items-center">
            <img src="{{ url('/icons/Calendar.svg') }}" alt="Image" class="h-5 w-5 mr-2" />
            <h3>{{ date('Y-m-d') }}</h3>
        </div>
        <div class="flex flex-row items-center">
            <img src="{{ url('/icons/Clock.svg') }}" alt="Image" class=" h-5 w-5 mr-2" />
            <h3 id="timeManila"></h3>
        </div>
    </div> --}}
{{-- </div> --}}
