@extends('layout')

@include('components.header_login')

<div class="flex-grow px-6 py-24 sm:py-24 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
      <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">{{__('Vibe Sync')}}</h2>
      <p class="mt-2 text-lg/8 text-gray-600">{{__('Login to find some mates')}}</p>
    </div>


    <form class="max-w-sm mx-auto" method="POST" action="{{ route('auth.login') }}">
      @csrf
      <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-700">{{__('Your email')}}</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('email') border-red-500 @enderror" placeholder="name@email.com" required />
          @error('email')
              <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
          @enderror
      </div>
  
      <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-700">{{__('Your password')}}</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('password') border-red-500 @enderror" required />
          @error('password')
              <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
          @enderror
          <p id="helper-text-explanation" class="mt-2 text-sm text-blue-200 dark:text-blue-200">{{__('Forgot your password?')}} <a href="" class="font-medium text-gray-600 hover:underline dark:text-gray-800">{{__('Click here')}}</a>.</p>
      </div>
  
      {{-- <div class="flex items-start mb-5">
          <div class="flex items-center h-5">
              <input id="remember" name="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-gray-300 dark:bg-gray-700" {{ old('remember') ? 'checked' : '' }} />
          </div>
          <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-700">{{__('Remember me')}}</label>
      </div> --}}
  
      <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:focus:ring-gray-800">{{__('Login')}}</button>
  
      <div class="sm:mb-8 sm:flex sm:justify-center mt-5">
          <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
              {{__('Don\'t have an account?')}}<a href="{{ route('page.register') }}" class="font-semibold text-blue-200"><span aria-hidden="true">&rarr;</span>{{__('Register here')}}</a>
          </div>
      </div>
  </form>
  

</div>
  
  @include('components.footer')