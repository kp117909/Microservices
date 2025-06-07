@extends('layout')

@include('components.header_login')

<div class="flex-grow container max-w-full px-4 mx-auto p-6 mt-24">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-xl md:text-xl font-extrabold text-gray-900 dark:text-white mb-6">{{__('Users List')}}</h2>
    </div>
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 bg-gray-900 sm:rounded-3xl">
        <!-- FILTRY -->
        <form method="GET" action="" class="w-full mb-6">
            <div class="flex flex-col sm:flex-row flex-wrap sm:items-end gap-4">
                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block mb-1 text-sm font-medium text-white">{{__('Search')}}</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                        placeholder="Name or Email">
                </div>

                <!-- Genre -->
                <div class="flex-1 min-w-[200px]">
                    <label for="genre" class="block mb-1 text-sm font-medium text-white">{{__('Music Genre')}}</label>
                    <select name="genre" id="genre"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                        <option value="">{{__('All')}}</option>
                        <option value="Rock" @selected(request('genre') == 'Rock')>{{__('Rock')}}</option>
                        <option value="Pop" @selected(request('genre') == 'Pop')>{{__('Pop')}}</option>
                        <option value="Jazz" @selected(request('genre') == 'Jazz')>{{__('Jazz')}}</option>
                        <option value="Hip-Hop" @selected(request('genre') == 'Hip-Hop')>{{__('Hip-Hop')}}</option>
                    </select>
                </div>

                <!-- Location -->
                <div class="flex-1 min-w-[200px]">
                    <label for="location" class="block mb-1 text-sm font-medium text-white">{{__('Location')}}</label>
                    <input type="text" name="location" id="location" value="{{ request('location') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                        placeholder="City or Country">
                </div>

                <!-- Submit button -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 text-sm font-medium text-white invisible">&nbsp;</label>
                    <button type="submit"
                            class="w-full text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-gray-800">
                        {{__('Save')}}
                    </button>
                </div>
            </div>
        </form>


        <!-- LISTA UŻYTKOWNIKÓW -->
        <div class="flow-root">
            <ul role="list" class="space-y-6">
                @foreach ($users as $user)
                    <li class="bg-gray-800 rounded-xl p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <img src="{{ Vite::asset('resources/images/logo_main_no.png') }}" alt="Profile Picture"
                                class=" w-24 h-20 transition-transform duration-300 hover:scale-105 mx-auto sm:mx-0">
                            <div class="flex-1 min-w-0 text-center sm:text-left">
                                <p class="text-sm font-medium text-white">{{ $user->name }}</p>
                                <p class="text-sm text-gray-400">{{ $user->email }}</p>
                                <p class="text-sm text-gray-400">{{ $user->country }}, {{ $user->city }}, {{ $user->zip_code }}</p>
                            </div>
                            <div class="text-center sm:text-right text-base font-semibold text-white">
                                {{ $user->music_genre }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- PAGINACJA -->
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-3">
            <a href="{{ $users->previousPageUrl() }}"
                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                {{ __('Previous') }}
            </a>

            <span class="text-sm text-gray-400">
                {{ __('Page') }} {{ $users->currentPage() }} {{ __('of') }} {{ $users->lastPage() }}
            </span>

            <a href="{{ $users->nextPageUrl() }}"
                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                {{ __('Next') }}
            </a>
        </div>
    </div>
</div>

@include('components.footer')
