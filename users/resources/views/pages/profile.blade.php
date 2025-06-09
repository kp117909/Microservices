@extends('layout')
  
@include('components.header_login')

<div class="flex-grow container mx-auto p-6 mt-12">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-balance  text-gray-600 sm:text-2xl">{{__('Profile Managment')}}</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">

            <form method="POST" action="{{ route('users_form.update', auth()->user()->id) }}">
                @csrf
                @method('PATCH')
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-xl md:text-xl font-extrabold text-gray-900 dark:text-white mb-6">{{__('Informations')}}</h2>
                </div>
                <div class="grid max-w-2xl mx-aut">
                    {{-- <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-blue-200 dark:ring-blue-200"
                            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGZhY2V8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60"
                            alt="Bordered avatar">

                        <div class="flex flex-col space-y-8 sm:ml-8">
                            <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:focus:ring-gray-800">{{__('Change Picture')}}</button>
                            <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:focus:ring-gray-800">{{__('Delete Picture')}}</button>
                        </div>
                    </div> --}}
       
                    <div class="items-center mt-8 sm:mt-4 text-[#202142] ">
                        <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                
                            <div class="w-full">
                                <label for="name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your Name')}}</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('name') border-red-500 @enderror" />
                                @error('name')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label for="music_genre" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your Favourites Music Genre')}}</label>
                                <input type="text" id="music_genre" name="music_genre" value="{{ auth()->user()->music_genre }}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('email') border-red-500 @enderror" />
                                @error('music_genre')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                            <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            
                                <div class="w-full">
                                    <label for="first_name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your First Name')}}</label>
                                    <input type="text" id="first_name" name="first_name" value="{{ auth()->user()->first_name }}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('first_name') border-red-500 @enderror" />
                                    @error('first_name')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="w-full">
                                    <label for="last_name" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your Last Name')}}</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ auth()->user()->last_name }}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('last_name') border-red-500 @enderror" />
                                    @error('last_name')
                                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            <div class="w-full">
                                <label for="email" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your Email')}}</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('email') border-red-500 @enderror" />
                                @error('email')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="w-full">
                                <label for="phone" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Your Phone')}}</label>
                                <input type="text" id="phone" name="phone"  maxlength="9" value="{{ auth()->user()->phone }}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('phone') border-red-500 @enderror" />
                                @error('phone')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            

                        </div>
                        
                          <div class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">

                            
                            <div class="w-full">
                                <label for="country" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Country')}}</label>
                                <input type="country" id="country" name="country" value="{{auth()->user()->country}} "class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('country') border-red-500 @enderror" />
                                @error('country')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                               <div class="w-full">
                                <label for="city" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('City')}}</label>
                                <input type="city" id="city" name="city" value="{{auth()->user()->city}} "class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('city') border-red-500 @enderror" />
                                @error('city')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                               <div class="w-full">
                                <label for="zip_code" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">{{__('Zip Code')}}</label>
                                <input type="zip_code" id="zip_code" name="zip_code" value="{{auth()->user()->zip_code}}"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('zip_code') border-red-500 @enderror" />
                                @error('zip-code')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full max-w-md px-5 py-2.5 text-center dark:focus:ring-gray-800">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <hr class="my-6 border-gray-300 dark:border-gray-600">

            {{-- <div class="flex flex-col items-center w-full mb-6">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-xl md:text-xl font-extrabold text-gray-900 dark:text-white mb-6">
                        {{ __('Change Your Password') }}
                    </h2>
                </div>

                <div class="w-full max-w-2xl grid gap-4">
                    <div class="w-full">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">
                            {{ __('Old Password') }}
                        </label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('password') border-red-500 @enderror" />
                        @error('password')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="password_confirmation" class="block mb-2 text-sm font-bold text-gray-900 dark:text-gray-700">
                            {{ __('New Password') }}
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500 @error('password_confirmation') border-red-500 @enderror" />
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                   <div class="flex justify-center mt-2">
                        <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full max-w-md px-5 py-2.5 text-center dark:focus:ring-gray-800">
                            {{ __('Change Password') }}
                        </button>
                    </div>
            </div> --}}

        </div>
        
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
            <div class="mx-auto max-w-2xl text-center">
                  <h2 class="text-xl md:text-xl font-extrabold text-gray-900 dark:text-white mb-6">{{__('Your events')}}</h2>
            </div>
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                <div class="space-y-8">
                    @foreach($user_events as $event)
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                        <span class="bg-green-100 text-blue-800 text-xs font-medium inline-block px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                        {{$event['type']}} / {{$event['music_genre']}} 
                        </span>
                        <h3 class="text-gray-900 dark:text-white text-2xl font-bold mb-2"> {{$event['name']}}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2"> {{$event['start_time']}} & {{$event['end_time'] ?? ''}} </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2"> {{$event['location']}} </p>
                        <p class="text-base text-gray-600 dark:text-gray-300 mb-4">
                        {{$event['description']}}
                        </p>
                        <div class="flex justify-between w-full">
                            <form method="POST" action="{{ route('users.event.leave', $event['id']) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center justify-center text-white bg-red-900 hover:bg-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Leave Event
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $user_events->links() }}
                    </div>
                </div>
            </div>    
        </div>

           @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="fixed bottom-4 right-4 max-w-xs bg-purple-900 text-white px-4 py-3 rounded-lg shadow-lg z-50"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="fixed bottom-4 right-4 max-w-xs bg-red-900 text-white px-4 py-3 rounded-lg shadow-lg z-50"
                >
                    {{ session('error') }}
                </div>
            @endif

    </div>
</div>

@include('components.footer')