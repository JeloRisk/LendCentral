{{-- <div class=" fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm
"> --}}
<div class="ml-4 flex h-[2rem] w-[40rem] flex-row items-center">
    <form action="/item-list?" class="flex-1 w-full relative">
        <input type="text" name="search_query"
            class="h-[2rem] flex w-full overflow-hidden rounded-lg border-[1px] focus:ring-0 focus:border-slate-400 focus:text-[#9f9f9f] bg-transparent p-5 text-slate-500"
            value="{{ $searchQuery ?? '' }}"
            placeholder="{{ __('Item Search') }}">
        <img src="{{ url('/icons/Search.svg') }}" alt="Search Icon"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 h-5 w-5 focus:invert"
        />
    </form>
</div>

{{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="11" cy="11" r="8" />
  <path d="M21 21l-4.35-4.35" />
</svg>
 --}}


{{-- <div class="relative max-w-xs text-gray-600 focus-within:text-gray-800">
  <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
      <path
        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
    </svg>
  </div>
  <input
    class="w-full h-10 pl-8 text-gray-700 placeholder-gray-600 bg-gray-200 rounded-lg shadow-md focus:bg-white"
    type="text"
    placeholder="Search for something" />
</div> --}}

  



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
