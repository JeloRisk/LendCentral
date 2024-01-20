<x-guest-layout>
  <body class="h-full">
      <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
              <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
              <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login as Admin</h2>
              <h3 class="text-[#ABABAB]">
                  {{-- Add any additional content here --}}
              </h3>
          </div>

          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
              <form class="space-y-6" action="{{ route('login') }}" method="POST">
                  @csrf

                  <!-- Email Address -->
                  <div>
                      <x-input-label class="font-bold" for="identifier" :value="__('Email')" />
                      <x-text-input id="identifier" class="mt-1 block w-full bg-transparent" type="text" name="email" :value="old('identifier')"
                          required autofocus autocomplete="username" />
                  </div>

                  <!-- Password -->
                  <div class="mt-4">
                      <x-input-label class="font-bold" for="password" :value="__('Password')" />
                      <x-text-input id="password" class="mt-1 block w-full bg-transparent" type="password" name="password" required
                          autocomplete="current-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>

                  <x-primary-button class="my-4 flex w-full justify-center bg-[#042558] py-4">
                      {{ __('Log in') }}
                  </x-primary-button>

                  <div class="flex justify-between text-sm">
                      <div class="flex flex-row">
                          <h4>New User?</h4>
                          <a class="rounded-md text-sm underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                              href="{{ route('register') }}">
                              {{ __('Sign Up Here') }}
                          </a>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </body>
</x-guest-layout>
