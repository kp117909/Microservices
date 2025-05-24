@extends('layout')

@include('components.header_login')

<div class="flex-grow container mx-auto p-6 mt-24">
  <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-12 lg:px-8 bg-gray-900 sm:rounded-3xl">
      <div class="flex items-center justify-between mb-4">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{__('Users List')}}</h5>
      </div>

      <!-- FILTRY -->
      <form method="GET" action="" class="w-full mb-6">
          <div class="flex flex-col sm:flex-row sm:items-end gap-4">
              <!-- Search -->
              <div class="w-full sm:w-1/3">
                  <label for="search" class="block mb-1 text-sm font-medium text-white">{{__('Search')}}</label>
                  <input type="text" name="search" id="search" value="{{ request('search') }}"
                         class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                         placeholder="Name or Email">
              </div>

              <!-- Genre -->
              <div class="w-full sm:w-1/3">
                  <label for="genre" class="block mb-1 text-sm font-medium text-white"{{__('Music Genre')}}</label>
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
              <div class="w-full sm:w-1/3">
                  <label for="location" class="block mb-1 text-sm font-medium text-white">{{__('Location')}}</label>
                  <input type="text" name="location" id="location" value="{{ request('location') }}"
                         class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600"
                         placeholder="City or Country">
              </div>

              <div>
                  <div class="flex">
                    <button type="submit" class="text-white dark:bg-gray-600 hover:dark:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:focus:ring-gray-800">{{__('Save')}}</button>
                </div>
              </div>
          </div>
      </form>

      <div class="flow-root">
          <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($users as $user)
                  <li class="py-3 sm:py-4">
                     <div class="flex items-center">
                        <img src="https://i.pravatar.cc/300" alt="Profile Picture" class="rounded-full w-16 h-16 mx-auto border-4 border-gray-800 mb-4 transition-transform duration-300 hover:scale-105 ring ring-gray-300">
                        <div class="flex-1 min-w-0 ms-4">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                        </div>
                        <div class="flex items-center gap-3 text-base font-semibold text-gray-900 dark:text-white">
                            &nbsp;{{ $user->music_genre }}
                            <a href="" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-600 hover:bg-gray-800 text-white transition" title="Private chat">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.978 9.978 0 01-4.41-1.026L3 21l1.84-4.617A8.96 8.96 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </a>

                            <a href="#" class="inline-flex items-center justify-center w-8 h-10 text-white bg-red-900 hover:bg-red-700 rounded-full" title="Report user">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5v14M5 5h9l-1.5 4L14 13H5"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                  </li>
              @endforeach
          </ul>
      </div>

      <div class="mt-4 flex justify-between items-center">
          <a href="{{ $users->previousPageUrl() }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
              {{__('Previous')}}
          </a>

          <span class="text-sm text-gray-500 dark:text-gray-400">{{__('Page')}} {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>

          <a href="{{ $users->nextPageUrl() }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
              {{__('Next')}}
          </a>
      </div>
  </div>
</div>

@include('components.footer')
