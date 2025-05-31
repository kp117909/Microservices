@extends('layout')

@include('components.header_login')

<div class="flex-grow isolate px-6 py-24 sm:py-32 lg:px-8">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
      <div class="relative left-1/2 -z-10 aspect-1155/678 w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
    </div>
    <div class="mx-auto max-w-2xl text-center">
      <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">{{__('Vibes Sync')}}</h2>
      <p class="mt-2 text-lg/8 text-blue-200">{{__('Register to our community')}}</p>
    </div>
    

  <form class="max-w-md mx-auto" method="POST" action="{{ route('auth.register') }}">
    @csrf
    <div class="relative z-0 w-full mb-5 group">
      <input type="text" value = "{{old('name')}}" name="name" id="name" class="block py-2.5 px-0 w-full text-sm 
          @error('name') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
          bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
      <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Name')}}</label>
      @error('name')
          <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
      @enderror
  </div>
  
  <div class="relative z-0 w-full mb-5 group">
      <input type="email" value = "{{old('email')}}" name="email" id="email" class="block py-2.5 px-0 w-full text-sm 
          @error('email') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
          bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
      <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Email address')}}</label>
      @error('email')
          <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
      @enderror
  </div>

   <div class="grid md:grid-cols-3 md:gap-6">

    <div class="relative z-0 w-full mb-5 group">
        <input type="text" value = "{{old('country')}}" name="country" id="country" class="block py-2.5 px-0 w-full text-sm 
            @error('country') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
            bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
        <label for="country" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Country')}}</label>
        @error('country')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="relative z-0 w-full mb-5 group">
        <input type="text" value = "{{old('city')}}" name="city" id="city" class="block py-2.5 px-0 w-full text-sm 
            @error('city') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
            bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
        <label for="city" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('City')}}</label>
        @error('city')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    
    <div class="relative z-0 w-full mb-5 group">
                @error('zip_code')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
        <input type="text" value = "{{old('zip_code')}}" name="zip_code" id="zip_code" class="block py-2.5 px-0 w-full text-sm 
            @error('zip-code') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
            bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
        <label for="zip_code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Zip Code')}}</label>
    </div>

  </div>

 <div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" value = "{{old('password')}}" name="password" id="password" class="block py-2.5 px-0 w-full text-sm 
            @error('password') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
            bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
        <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Password')}}</label>
        @error('password')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="relative z-0 w-full mb-5 group">
        <input type="password" value = "{{old('password_confirmation')}}" name="password_confirmation" id="password_confirmation" class="block py-2.5 px-0 w-full text-sm 
            @error('password_confirmation') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
            bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
        <label for="password_confirmation" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Confirm password')}}</label>
        @error('password_confirmation')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>
  </div>

  
  <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text"  value = "{{old('first_name')}}" name="first_name" id="first_name" class="block py-2.5 px-0 w-full text-sm 
              @error('first_name') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
              bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
          <label for="first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('First name')}}</label>
          @error('first_name')
              <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
      </div>
  
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" value = "{{old('last_name')}}" name="last_name" id="last_name" class="block py-2.5 px-0 w-full text-sm 
              @error('last_name') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
              bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
          <label for="last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Last name')}}</label>
          @error('last_name')
              <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
      </div>
  </div>
  
  <div class="grid md:grid-cols-2 md:gap-6">
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" value = "{{old('phone')}}" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" maxlength="9" name="phone" id="phone" class="block py-2.5 px-0 w-full text-sm 
              @error('phone') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
              bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
          <label for="phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Phone number (123456789)')}}</label>
          @error('phone')
              <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
      </div>
  
      <div class="relative z-0 w-full mb-5 group">
          <input type="text" value = "{{old('music_genre')}}" name="music_genre" id="music_genre" class="block py-2.5 px-0 w-full text-sm 
              @error('music_genre') dark:border-red-500 text-red-900 @else border-gray-300 text-gray-900 @enderror
              bg-transparent border-b-2 appearance-none dark:text-gray-500 dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
          <label for="music_genre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-800 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{__('Favorites music genre')}}</label>
          @error('music_genre')
              <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
      </div>
  </div>
  
    <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:focus:ring-gray-800">Register</button>
  </form> 
    <div class="hidden sm:mb-8 sm:flex sm:justify-center mt-5">
      <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
        {{__('Already have a account')}}?<a href="{{ route('login') }}" class="font-semibold text-blue-200"><span aria-hidden="true">&rarr;</span>{{__('Login here')}}</a>
      </div>
  </div> 
  </div>
  
  @include('components.footer')