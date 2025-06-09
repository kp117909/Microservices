@extends('layout')

@include('components.header')

<div class="flex-grow container mx-auto p-6 mt-12">
    <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-bold tracking-tight text-balance text-white sm:text-2xl">{{ __('Event Details') }}</h2>
    </div>

    <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg mx-auto mt-8">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">

                <form action="{{ route('event.update', ['id' => $event->id, 'session_id' => request('session_id')]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="name" class="block mb-1 font-semibold  text-white">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required
                        class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 " />

                    <label for="description" class="block mb-1 font-semibold  text-white ">Description</label>
                    <textarea name="description" id="description" rows="4" required
                            class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">{{ old('description', $event->description) }}</textarea>

                    <label for="location" class="block mb-1 font-semibold  text-white">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required
                        class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600" />

                    <label for="start_time" class="block mb-1 font-semibold  text-white">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" required
                        value="{{ old('start_time', $event->start_time?->format('Y-m-d\TH:i')) }}"
                        class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 " />

                    <label for="end_time" class="block mb-1 font-semibold text-white ">End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" required
                        value="{{ old('end_time', $event->end_time?->format('Y-m-d\TH:i')) }}"
                        class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600" />

                    <label for="music_genre" class="block mb-1 font-semibold text-white">Music Genre</label>
                    <select name="music_genre" id="music_genre" required class="w-full mb-3 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                        @php
                            $genres = ['Rock', 'Pop', 'Jazz', 'Hip-Hop'];
                            $selectedGenre = old('music_genre', $event->music_genre);
                        @endphp
                        @foreach ($genres as $genre)
                            <option value="{{ $genre }}" {{ $selectedGenre === $genre ? 'selected' : '' }}>{{ __($genre) }}</option>
                        @endforeach
                    </select>

                    <label for="type" class="block mb-1 font-semibold text-white">Type</label>
                    <select name="type" id="type" required class="w-full mb-6 p-2 border rounded  border-gray-300 focus:ring-pink-500 focus:border-pink-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                        @php
                            $types = ['Concert', 'Festival', 'Meetup', 'Workshop'];
                            $selectedType = old('type', $event->type);
                        @endphp
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>{{ __($type) }}</option>
                        @endforeach
                    </select>

                    <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700">
                        Update Event
                    </button>
                </form>

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
</div>

@include('components.footer')
