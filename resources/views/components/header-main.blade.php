<div class=" fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm
md:pl-[20%]">
<div class="ml-4 flex h-full flex-1 flex-row items-center gap-2 overflow-hidden rounded-lg border-2 border-slate-200">
    <form action="/item-list?" class="flex-1 relative">
        <input type="text" name="search_query"
            class="flex w-full border-0 bg-transparent outline-none focus:border-0 focus:outline-none p-5"
            value="{{ $searchQuery ?? '' }}"
            placeholder="{{ __('Item Search') }}">
        <img src="{{ url('/icons/Search.svg') }}" alt="Search Icon" class="absolute right-3 top-1/2 transform -translate-y-1/2 h-5 w-5" />
    </form>
</div>

    <div
        class="ml-4 hidden h-full flex-row items-center justify-center gap-4 overflow-hidden rounded-lg border-2 border-slate-200 px-4 md:flex">
     
        <div class="flex flex-row items-center">
            <img src="{{ url('/icons/Calendar.svg') }}" alt="Image" class="h-5 w-5 mr-2" />
            <h3>{{ date('Y-m-d') }}</h3>
        </div>
        <div class="flex flex-row items-center">
            <img src="{{ url('/icons/Clock.svg') }}" alt="Image" class=" h-5 w-5 mr-2" />
            <h3 id="timeManila"></h3>
        </div>
    </div>
</div>
