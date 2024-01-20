<x-guest-layout>
  <body class="h-full">
      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      

              
              
              <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register</h2>
          </div>

          <div class="mt-1 sm:mx-auto sm:w-full sm:max-w-sm">
              <form class="space-y-2" action="{{ route('register') }}" method="POST">
                  @csrf
                  <!-- Name -->
                  <div>
                      <x-input-label for="name" :value="__('Name')" />
                      <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>

                  <!-- Email Address -->
                  <div class="mt-4">
                      <x-input-label class="font-bold" for="identifier" :value="__('Email')" />
                      <x-text-input id="identifier" class="block mt-1 w-full" type="text" name="identifier" :value="old('identifier')"
                          required autocomplete="username" />
                      {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                  </div>

                  <!-- Password -->
                  <div class="mt-4">
                      <x-input-label class="font-bold" for="password" :value="__('Password')" />
                      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                          autocomplete="new-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                  <!-- Confirm Password -->
                  <div class="mt-4">
                      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                      <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                          required autocomplete="new-password" />
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>

                  <x-primary-button class="w-full flex justify-center my-4 py-4 bg-[#26476d]">
                      {{ __('Register') }}
                  </x-primary-button>

                  <div class="flex items-center text-gray-600 justify-between mt-4">
                      <div class="flex flex-row">
                          <h4 class="text-sm">{{ __('New User?') }}</h4>
                          <a class="underline text-sm hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              href="{{ route('login') }}">
                              {{ __('Already registered?') }}
                          </a>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </body>
</x-guest-layout>
