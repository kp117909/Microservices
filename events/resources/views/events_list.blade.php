@extends('layout')

<div>
  
  @include('components.header')

  <div class="flex-grow container mx-auto p-6 mt-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

      <aside class="lg:col-span-1 bg-white dark:bg-gray-800 mt-20 p-4 rounded-lg shadow-md h-fit">

        <div class="text-center text-white font-semibold  text-lg mb-4">{{__('Filters')}}</div>
        <form method="GET" action="{{ route('page.events') }}" class="space-y-4">
          <input type="hidden" name="session_id" value="{{ request('session_id') }}">
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
          </div>
        </form>
        <form method="GET" action="{{ route('page.events') }}" class="inline">
          <input type="hidden" name="session_id" value="{{ request('session_id') }}">
            <div class="flex justify-center gap-4 mt-2">
            <button type="submit"
              class="flex-1 inline-flex items-center justify-center text-white bg-pink-900 hover:bg-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              {{__('Clear Filters')}}
            </button>
          </div>
        </form>

        <hr class="my-6 border-gray-300 dark:border-gray-600">
        @if($user && $user->is_admin)
        <div class="text-center text-white font-semibold  text-lg mb-4">{{__('Create New Event')}}</div>
          <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
              <label for="name" class="block mb-1 text-sm font-medium text-white">{{__('Name')}}</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="location" class="block mb-1 text-sm font-medium text-white">   {{__('Location')}}</label>
              <input type="text" name="location" id="location" value="{{ old('location') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                @error('location')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
              <label for="start_time" class="block mb-1 text-sm font-medium text-white">{{ __('Start Time') }}</label>
              <input type="datetime-local" name="start_time" id="start_time" 
                value="{{ old('start_time') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              @error('start_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="end_time" class="block mb-1 text-sm font-medium text-white">{{ __('End Time') }}</label>
              <input type="datetime-local" name="end_time" id="end_time" 
                value="{{ old('end_time') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
              @error('end_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="type" class="block mb-1 text-sm font-medium text-white">{{ __('Type') }}</label>
              <select name="type" id="type"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                <option value="Concert" {{ old('type') == 'Concert' ? 'selected' : '' }}>{{ __('Concert') }}</option>
                <option value="Festival" {{ old('type') == 'Festival' ? 'selected' : '' }}>{{ __('Festival') }}</option>
                <option value="Meetup" {{ old('type') == 'Meetup' ? 'selected' : '' }}>{{ __('Meetup') }}</option>
                <option value="Workshop" {{ old('type') == 'Workshop' ? 'selected' : '' }}>{{ __('Workshop') }}</option>
              </select>
              @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="music_genre" class="block mb-1 text-sm font-medium text-white">{{ __('Genre') }}</label>
              <select name="music_genre" id="music_genre"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                <option value="Rock" {{ old('music_genre') == 'Rock' ? 'selected' : '' }}>{{ __('Rock') }}</option>
                <option value="Pop" {{ old('music_genre') == 'Pop' ? 'selected' : '' }}>{{ __('Pop') }}</option>
                <option value="Jazz" {{ old('music_genre') == 'Jazz' ? 'selected' : '' }}>{{ __('Jazz') }}</option>
                <option value="Hip-Hop" {{ old('music_genre') == 'Hip-Hop' ? 'selected' : '' }}>{{ __('Hip-Hop') }}</option>
              </select>
              @error('music_genre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="description" class="block mb-1 text-sm font-medium text-white">{{ __('Description') }}</label>
              <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">{{ old('description') }}</textarea>
              @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>


            <div class="flex justify-center">
              <button type="submit"
                class="inline-flex items-center justify-center text-white bg-purple-900 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5">
               {{__(' Create Event')}}
              </button>
            </div>
          </form>
          @endif
      </aside>

      
      <section class="lg:col-span-3">
        <div class="mx-auto max-w-7xl py-4 sm:px-6 sm:py-6 lg:px-8">
          <div class="px-2 lg:px-4 xl:px-6">

            <div class="mx-auto max-w-2xl text-center mb-8">
              <h2 class="text-xl md:text-xl font-extrabold text-gray-800 dark:text-white mb-6">{{ __('Events List') }}</h2>
            </div>

            <div class="flex flex-col gap-8">
              @foreach($pagedEvents as $item)
                @php
                  $event = $item['event'];
                  $attendees = $item['attendees'];
                @endphp
                
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
                      <div class="flex justify-center">
                          <button id="deleteButton-{{$event->id}}"  data-modal-target="deleteModal-{{ $event->id }}" data-modal-toggle="deleteModal-{{ $event->id }}"  class="blockbg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white hover:bg-red-700 dark:bg-pink-900 dark:hover:bg-red-800" type="button">
                            {{__('Show delete confirmation')}}
                          </button>
                      </div>
                      <div id="deleteModal-{{ $event->id }}" tabindex="-1" aria-hidden="true" class="hidden flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                          <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                              <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                  <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal-{{ $event->id }}">
                                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                      <span class="sr-only">Close modal</span>
                                  </button>
                                  <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                  <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                                  <form action="{{ route('event.destroy', [ 'id' => $event->id , 'session_id' => request('session_id')])}}" method="POST">
                                  @csrf
                                  <div class="flex justify-end space-x-4">
                                    <input type="hidden" name="session_id" value="{{ request('session_id') }}">
                                    <button 
                                      type="button" 
                                      data-modal-toggle="deleteModal-{{ $event->id }}" 
                                      class="py-2 px-4 bg-gray-200 rounded hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600"
                                    >
                                        {{__('Cancel')}}
                                    </button>
                                    <button 
                                      type="submit" 
                                      class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600"
                                    >
                                       {{__(' Delete')}}
                                    </button>
                                  </div>
                                </form>
                              </div>
                          </div>
                      </div>

                    <span class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                      {{__('Edit')}}
                    </span>
                  
                  <h3 class="flex items-center text-gray-900 dark:text-white text-2xl font-bold mb-2 relative group">
                       @if($user && $user->is_admin)
                        <a href="{{ route('event.details', ['event_id' => $event->id, 'session_id' => request('session_id')]) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" 
                              class="h-6 w-6 text-blue-500 mr-2 cursor-pointer hover:text-pink-300" 
                              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" 
                              role="img" aria-label="Edit">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09A1.65 1.65 0 009 3V2a2 2 0 114 0v.09a1.65 1.65 0 001 1.51h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z" />
                          </svg>
                        </a>

                        <span class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                              {{__('Edit')}}
                        </span>
                        @endif
                      {{$event->name}}
                      
                  </h3>
                  @php
                    $dropdownId = 'dropdownUsers-' . $event->id; 
                  @endphp
                  <div class="relative inline-block text-left">
                    <button 
                      id="dropdownUsersButton-{{ $event->id }}"
                      data-event-id="{{ $event->id }}"
                      data-dropdown-toggle="dropdownUsers-{{ $event->id }}"
                      data-dropdown-placement="bottom" 
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-3 py-1.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                      type="button">
                      Attendees list
                      <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="{{ $dropdownId }}" class="absolute top-full left-0 z-10 hidden bg-white rounded-lg shadow-lg min-w-[12rem] max-h-70 overflow-y-auto dark:bg-gray-700">
                      <div class="p-3">
                        <label for="input-group-search-{{ $event->id }}" class="sr-only">Search</label>
                        <div class="relative">
                          <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                          </div>
                          <input type="text" id="input-group-search-{{ $event->id }}" data-event-id="{{ $event->id }}" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search user">
                        </div>
                      </div>
                      <ul id="attendees-list-{{ $event->id }}" class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton-{{$event->id}}">
                        @forelse ($attendees as $participant)
                          <li class="attendee-item">
                            <span class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                              <img class="w-6 h-6 me-2 rounded-full" 
                                  src="{{ $participant['url'] ?? Vite::asset('resources/images/logo_main.png') }}" 
                                  alt="{{ $participant['name'] }} avatar">
                              {{ $participant['name'] }}
                            </span>
                          </li>
                        @empty
                          <li class="px-4 py-2 text-gray-500 dark:text-gray-400">{{ __('No participants yet.') }}</li>
                        @endforelse
                      </ul>

                    </div>   
                  </div>  
                

                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{__('Location:')}} {{ $event->location }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                   {{__(' Start:')}} {{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d H:i') }}<br>
                    @if($event->end_time)
                    {{__('End: ')}}{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d H:i') }}
                    @endif
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{__('Genre: ')}}{{ $event->music_genre }}</p>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{__('Type: ')}}{{ $event->type }}</p>

                  <p class="text-base text-gray-600 dark:text-gray-300 mb-4">
                    {{ $event->description ?? 'No description available.' }}
                  </p>

                  <div class="flex justify-between w-full space-x-4">

                

                </div>
                  
                   @if($user)
                  <div class="flex justify-between w-full space-x-4 mt-2">
                    <form method="POST" action="{{ route('events.join')}}" class="flex-1">
                      @csrf
                      <input type="hidden" name="event_id" value="{{ $event->id }}">
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                      <input type="hidden" name="event_name" value="{{ $event->name }}">
                      <button type="submit"
                          class="w-full inline-flex items-center justify-center text-white bg-purple-900 hover:bg-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                         {{__(' Join Event')}}
                      </button>
                    </form>
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
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


            <div class="mt-8">
              {{ $pagedEvents->appends(request()->except('page'))->links() }}
            </div>

          </div>
        </div>
      </section>

    </div>
  </div>
</div>

@include('components.footer')
