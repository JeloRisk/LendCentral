<div class="fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm md:pl-[20%]">
  <button @click="open = ! open"
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
    <div class="flex h-full items-center bg-slate-100 px-4">
      <h3>Search</h3>

    </div>
    <form action="test?">

      <input type="text" name="search_query"
        class="flex flex-1 border-0 bg-transparent outline-none focus:border-0 focus:outline-none"
        placeholder="Search Name">

    </form>
    <img src="{{ url('/images/Search.svg') }}" alt="Image" class="mr-4" />
  </div>
  <div
    class="ml-4 hidden h-full flex-row items-center justify-center gap-4 overflow-hidden rounded-full border-2 border-slate-300 px-4 md:flex">
    <div class="flex flex-row items-center">
      <img src="{{ url('/images/Vector.svg') }}" alt="Image" class="mr-2" />
      <h3 id="time"></h3>
      {{-- <h3>09.00 HRS</h3> --}}
    </div>
    <div class="flex flex-row items-center">
      <img src="{{ url('/images/Vector2.svg') }}" alt="Image" class="mr-2" />
      {{-- <h3>4-MAR-2023</h3> --}}
      <h3>{{ date('Y-m-d') }}</h3>
    </div>
  </div>
</div>
