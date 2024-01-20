<x-guest-layout>
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="my-2 text-center">
      <h2>
        Login as Admin
      </h2>
      <h3 class="text-[#ABABAB]">
        
      </h3>
    </div>

    <div>
      <x-input-label class="font-bold" for="identifier" :value="__('Email')" />
      <x-text-input id="identifier" class="mt-1 block w-full bg-transparent" type="text" name="email" :value="old('identifier')"
        required autofocus autocomplete="username" />

    </div>

    <div class="mt-4">
      <x-input-label class="font-bold" for="password" :value="__('Password')" />

      <x-text-input id="password" class="mt-1 block w-full bg-transparent" type="password" name="password" required
        autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>


  



    <x-primary-button class="my-4 flex w-full justify-center bg-[#042558] py-4">
      {{ __('Log in') }}
    </x-primary-button>
    {{-- </div> --}}
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
</x-guest-layout>
