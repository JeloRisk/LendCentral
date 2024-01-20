<x-app-layout>
  <div class="w-full">
    <table
      class="w-full table-fixed border-separate border-spacing-y-2 border-spacing-x-2 px-2 text-xs md:border-spacing-x-4 md:px-4 md:text-base">
      <thead class="text-left">
        <tr class="">
          <th class="w-[10%]">Cover</th>
          <th class="w-[30%] md:w-[40%]">Title</th>
          <th class="hidden w-[20%] sm:flex">Category</th>
          <th class="w-[15%]">Status</th>
          <th class="w-[15%]">Edit</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($books as $book)
          <tr>
            <td>
              <img src="{{ url('/images/book.png') }}" alt="Image" class="shadow-md" />
            </td>
            <td class="">
              <div class="flex flex-col">
                <h3 class="text-sm font-bold md:text-lg">{{ $book->title }}</h3>
                <h4 class="text-sm">{{ $book->author->name }}, 2000</h4>
                <span class="text-xs">{{ $book->synopsis }}</span>
              </div>
            </td>
            <td class="hidden sm:flex">
              <div class="flex flex-col">
                <h3>Ilmu Komputer</h3>
                <h4 class="text-sm">{{ $book->categories[0]->name }}</h4>
              </div>
            </td>
            <td>
              <div class="flex flex-col gap-2">
                <h3 class="rounded-md bg-[#052355] py-1 px-1 text-center text-white md:px-2">Tersedia</h3>
                <div class="flex flex-row items-center text-sm">
                  <img src="{{ url('/images/map-pin.svg') }}" alt="Image" />
                  <span>
                    B-10
                  </span>
                </div>
              </div>
            </td>
            <td>
              <button class="w-max rounded-md border border-[#517DAB] py-1 px-2 md:border-2">
                Preview
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</x-app-layout>
