<x-app-layout>
  <script type="text/javascript">
    function showTime() {
      var date = new Date(),
        utc = new Date(Date.UTC(
          date.getFullYear(),
          date.getMonth(),
          date.getDate(),
          date.getHours(),
          date.getMinutes(),
          date.getSeconds()
        ));

      document.getElementById('time').innerHTML = utc.toLocaleTimeString('en-US', {
        timeZone: 'Asia/Jakarta',
      });
    }

    setInterval(showTime, 1000);
  </script>
     <div class=" fixed z-10 flex h-20 w-full flex-row items-center justify-between bg-white px-4 py-4 shadow-sm
     md:pl-[20%]">
         <button @click=" open=! open"
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
             <div class="hidden h-full items-center bg-slate-100 px-4 sm:flex">
                 <h3>All</h3>
 
             </div>
             <form action="daftar-buku?" class="flex-1">
 
                 <input type="text" name="search_query"
                     class="flex w-full border-0 bg-transparent outline-none focus:border-0 focus:outline-none"
                     placeholder="Search">
 
             </form>
             <img src="{{ url('/images/Search.svg') }}" alt="Image" class="mr-4" />
         </div>
         <div
             class="ml-4 hidden h-full flex-row items-center justify-center gap-4 overflow-hidden rounded-full border-2 border-slate-300 px-4 md:flex">
             <div class="flex flex-row items-center">
                 <img src="{{ url('/images/Vector.svg') }}" alt="Image" class="mr-2" />
                 <h3 id="time"></h3>
             </div>
             <div class="flex flex-row items-center">
                 <img src="{{ url('/images/Vector2.svg') }}" alt="Image" class="mr-2" />
                 <h3>{{ date('Y-m-d') }}</h3>
             </div>
         </div>
     </div>

  <div class="w-full pt-24 pl-0 md:pl-[20%]" x-data="{ modal: false }">


    <table
      class="w-full table-fixed border-separate border-spacing-y-2 border-spacing-x-2 px-2 text-xs md:border-spacing-x-4 md:px-4 md:text-sm lg:text-base">
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
        {{-- <p>Total Borrowed Items: {{ $totalBorrowedItems }}</p> --}}
        <p>Total Unreturned Items: {{ $totalUnreturnedItems }}</p>
        @foreach ($books as $book)
        
          <tr>
            <td>
              <img src="{{ $book->cover_url }}" alt="Image" class="shadow-md" />
            </td>
            <td class="">
              <div class="flex flex-col">
                <h3 class="text-sm font-bold md:text-lg">{{ $book->title }}</h3>
                {{-- <h4 class="text-sm">{{ $book->author->name }}, {{ $book->release_year }}</h4> --}}
                {{-- <span class="text-xs">ID:{{ $book->id }} , Edisi ke-{{ $book->edition }}</span> --}}
                <span class="text-xs">Kode:{{ $book->isbn }}</span>
              </div>
            </td>
            <td class="hidden sm:inline">
              <div class="flex flex-col text-sm">
                @foreach ($book->categories->slice(0, 3) as $category)
                  <h3>
                    {{ $category->name }},
                  </h3>
                @endforeach
              </div>
            </td>
            <td>
              <div class="flex flex-col gap-2">
                <h3
                  class="{{ !$book->status ? 'bg-[#052355]' : 'bg-[#7B9CC5]' }} rounded-md py-1 px-1 text-center text-white md:px-2">
                  {{ $book->status ? 'It is back' : 'Borrowed' }}
                </h3>
                <div class="flex flex-row items-center text-sm font-bold">
                  @foreach ($book->borrowedBookss as $item)
                    {{ $item->name }}
                  @endforeach
                </div>
              </div>
            </td>
            <td>
              {{-- <button @click="modal = ! modal" class="w-max rounded-md border border-[#517DAB] py-1 px-2 md:border-2">
                Update Status{{ $book->borrowed }}
                
              </button> --}}
              <a href="/book/{{ $book->id }}"
                class="w-max rounded-md border border-[#517DAB] py-1 px-2 shadow-md md:border-2">
                Preview
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Main modal -->
    <div :class="{ 'block': modal, 'hidden': !modal }" id="authentication-modal" tabindex="-1" aria-hidden="true"
      class="bg fixed top-0 left-0 right-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">

      <div class="fixed h-full w-full bg-slate-800 opacity-50">

      </div>
      <div class="relative top-[50%] left-[50%] max-h-full w-full max-w-md -translate-y-[50%] -translate-x-[50%]">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow">
          <button @click="modal = ! modal" type="button"
            class="absolute top-3 right-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-800 dark:hover:text-white"
            data-modal-hide="authentication-modal">
            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <form method="POST">
              @csrf

              <div class="my-2 text-center">
                <h2 class="font-bold">
                  Isi Data Diri
                </h2>
              </div>
              <!-- Email Address -->
              <div>
                <x-input-label class="font-bold" for="from" :value="__('Dari')" />
                <x-text-input id="from" class="mt-1 block w-full bg-transparent" type="date" name="from"
                  :value="old('from')" required />
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
              </div>

              <!-- Password -->
              <div class="mt-4">
                <x-input-label class="font-bold" for="to" :value="__('To')" />

                <x-text-input id="to" class="mt-1 block w-full bg-transparent" type="date" name="to"
                  required />

                {{-- <x-input-error :messages="$errors->get('to')" class="mt-2" /> --}}
              </div>
              <!-- Nama -->
              <div class="mt-4">
                <x-input-label class="font-bold" for="nama" :value="__('Nama: ')" />

                <x-text-input id="nama" class="mt-1 block w-full bg-transparent" type="text" name="nama"
                  required />

                {{-- <x-input-error :messages="$errors->get('to')" class="mt-2" /> --}}
              </div>
              <!-- Email -->
              <div class="mt-4">
                <x-input-label class="font-bold" for="Email" :value="__('Email: ')" />

                <x-text-input id="Email" class="mt-1 block w-full bg-transparent" type="email" name="Email"
                  required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>

              {{-- <div class="flex items-center justify-end mt-4"> --}}

              <div class="flex w-full justify-center">

                <x-primary-button class="my-4 flex w-max justify-center bg-[#042558] px-8 py-4">
                  {{ __('Pinjam') }}
                </x-primary-button>
              </div>
              {{-- </div> --}}
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

</x-app-layout>
