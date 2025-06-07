@extends('layout')

<div>
  
  @include('components.header')

  <div class="flex-grow container mx-auto p-6 mt-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

      
      <aside class="lg:col-span-1 bg-white dark:bg-gray-800 mt-20 p-4 rounded-lg shadow-md h-fit">

        <div class="text-center text-white font-semibold  text-lg mb-4">{{__('Filters')}}</div>
        <form method="GET" action="{{ url()->current() }}" class="space-y-4">

          <div>
            <label for="start_time" class="block mb-1 text-sm font-medium text-white">{{__('Start Date')}}</label>
            <input type="date" name="start_time" id="start_time" value="{{ request('start_time') }}"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

         
          <div>
            <label for="end_time" class="block mb-1 text-sm font-medium text-white">{{__('End Date')}}</label>
            <input type="date" name="end_time" id="end_time" value="{{ request('end_time') }}"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          
          <div>
            <label for="type" class="block mb-1 text-sm font-medium text-white">{{__('Type')}}</label>
            <select name="type" id="type"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              <option value="">All</option>
              @foreach (['Concert', 'Festival', 'Meetup', 'Workshop'] as $type)
                <option value="{{ $type }}" @selected(request('type') == $type)>{{ $type }}</option>
              @endforeach
            </select>
          </div>

          
          <div>
            <label for="genre" class="block mb-1 text-sm font-medium text-white">{{__('Music Genre')}}</label>
            <select name="genre" id="genre"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              <option value="">All</option>
              @foreach (['Rock', 'Pop', 'Jazz', 'Hip-Hop'] as $genre)
                <option value="{{ $genre }}" @selected(request('genre') == $genre)>{{ $genre }}</option>
              @endforeach
            </select>
          </div>

          
          <div>
            <label for="search" class="block text-sm font-medium text-white">{{__('Search')}}</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="{{__('Name or description')}}"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          
          <div class="flex justify-center gap-4">
            <button type="submit"
              class="flex-1 inline-flex items-center justify-center text-white bg-purple-900 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              {{__('Search')}}
            </button>
            <a href="{{ url()->current() }}"
              class="inline-flex items-center justify-center text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-4 py-2.5"
              title="Clear filters">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </a>
          </div>
        </form>


        <hr class="my-6 border-gray-300 dark:border-gray-600">

        <div class="text-center text-white font-semibold  text-lg mb-4">{{__('Create New Event')}}</div>

        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <div>
            <label for="name" class="block mb-1 text-sm font-medium text-white">Name</label>
            <input type="text" name="name" id="name" required
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          <div>
            <label for="location" class="block mb-1 text-sm font-medium text-white">Location</label>
            <input type="text" name="location" id="location" required
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          <div>
            <label for="start_time" class="block mb-1 text-sm font-medium text-white">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" required
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          <div>
            <label for="end_time" class="block mb-1 text-sm font-medium text-white">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
          </div>

          <div>
            <label for="type" class="block mb-1 text-sm font-medium text-white">Type</label>
            <select name="type" id="type" required
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              <option value="Concert">Concert</option>
              <option value="Festival">Festival</option>
              <option value="Meetup">Meetup</option>
              <option value="Workshop">Workshop</option>
            </select>
          </div>

          <div>
            <label for="music_genre" class="block mb-1 text-sm font-medium text-white">Genre</label>
            <select name="music_genre" id="music_genre"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              <option value="Rock">Rock</option>
              <option value="Pop">Pop</option>
              <option value="Jazz">Jazz</option>
              <option value="Hip-Hop">Hip-Hop</option>
            </select>
          </div>

          <div>
            <label for="description" class="block mb-1 text-sm font-medium text-white">Description</label>
            <textarea name="description" id="description" rows="3"
              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600"></textarea>
          </div>

          <div class="flex justify-center">
            <button type="submit"
              class="inline-flex items-center justify-center text-white bg-purple-900 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5">
              Create Event
            </button>
          </div>
        </form>
      </aside>

      
      <section class="lg:col-span-3">
        <div class="mx-auto max-w-7xl py-4 sm:px-6 sm:py-6 lg:px-8">
          <div class="px-2 lg:px-4 xl:px-6">

            <div class="mx-auto max-w-2xl text-center mb-8">
              <h2 class="text-xl md:text-xl font-extrabold text-gray-800 dark:text-white mb-6">{{ __('Check new events ') }}</h2>
            </div>

            <div class="flex flex-col gap-8">
              @foreach($events as $event)
              <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden mb-6">
                
                <div class="relative h-24 w-full rounded-t-lg overflow-hidden">
                  <div class="absolute inset-0 bg-cover bg-center"
                    style="
                      background-image: url('{{ $event->image_url ?? 'https://images.pexels.com/photos/1587927/pexels-photo-1587927.jpeg' }}');
                      mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
                      -webkit-mask-image: linear-gradient(to bottom, black 60%, transparent 100%);
                    ">
                  </div>
                </div>

                <div class="p-8 md:p-12">
                  <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-block px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 mb-2">
                    {{$event->type}}
                  </span>

                  <h3 class="flex items-center text-gray-900 dark:text-white text-2xl font-bold mb-2 relative group">
                          <svg xmlns="http://www.w3.org/2000/svg" 
                              class="h-6 w-6 text-blue-500 mr-2 cursor-pointer hover:text-pink-300" 
                              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" 
                              role="img" aria-label="Edit">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09A1.65 1.65 0 009 3V2a2 2 0 114 0v.09a1.65 1.65 0 001 1.51h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />
                          </svg>

                          <span class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                              Edit
                          </span>
                      {{ $event->name }}
                  </h3>

                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Location: {{ $event->location }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                    Start: {{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d H:i') }}<br>
                    @if($event->end_time)
                    End: {{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d H:i') }}
                    @endif
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Genre: {{ $event->music_genre }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Type: {{ $event->type }}</p>

                  <p class="text-base text-gray-600 dark:text-gray-300 mb-4">
                    {{ $event->description ?? 'No description available.' }}
                  </p>

                  <div class="flex justify-between w-full space-x-4">
                    <a href="#"
                      class="flex-1 inline-flex items-center justify-center text-white bg-gray-600 hover:bg-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      Event Details
                    </a>
                    <a href="#"
                      class="flex-1 inline-flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 00-3-3.87M16 4a4 4 0 11-8 0 4 4 0 018 0zM6 4a4 4 0 110 8 4 4 0 010-8z" />
                      </svg>
                      Participants
                    </a>
                  </div>

                  <div class="flex justify-between w-full space-x-4 mt-2">
                    <a href="#"
                      class="flex-1 inline-flex items-center justify-center text-white bg-purple-900 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                      Join Event
                    </a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

            <div class="mt-8">
              {{ $events->appends(request()->except('page'))->links() }}
            </div>

          </div>
        </div>
      </section>

    </div>
  </div>
</div>

@include('components.footer')
