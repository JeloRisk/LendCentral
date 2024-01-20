<x-app-layout>
  <div class="relative flex h-screen flex-col items-center justify-center gap-4 px-4 pt-24 md:pl-[22%]">
    <form action="item-list?" class="relative -top-20 flex w-[50%] flex-col gap-4">
      <input type="text" name="search_query"
        class="flex w-full flex-1 items-center rounded-lg border-2 shadow-lg outline-none focus:border-0 focus:outline-none"
        placeholder="Search Name">
      <button class="w-max rounded-lg bg-green-500 px-8 py-2 text-white shadow-lg duration-200 hover:scale-105">
        Search
      </button>
    </form>
  </div>
</x-app-layout>
