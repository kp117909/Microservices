@extends('layout')

@include('components.header_login')

<div class="flex-grow container mx-auto p-6 mt-24">
  <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-12 lg:px-8 bg-gray-900 sm:rounded-3xl">
      <div class="flex items-center justify-between mb-4">
          <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{{__('Users List')}}</h5>
      </div>
      <div class="flow-root">
          <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              <!-- Pętla przez użytkowników -->
              @foreach ($users as $user)
                  <li class="py-3 sm:py-4">
                      <div class="flex items-center">
                          {{-- <div class="shrink-0">
                              <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="{{ $user->name }} image">
                          </div> --}}
                          <div class="flex-1 min-w-0 ms-4">
                              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                  {{ $user->name }}
                              </p>
                              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                  {{ $user->email }}
                              </p>
                          </div>
                          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                              & {{ $user->music_genre }} &<!-- Zmienna 'balance' to przykładowa wartość, możesz to dopasować do swoich danych -->
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
