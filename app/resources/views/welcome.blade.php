@extends('layout')

<div class="bg-white">
  
  @include('components.header')

  <div class="flex-grow relative isolate px-6 pt-14 lg:px-8">
    <div class="mx-auto max-w-2xl py-20 sm:py-48 lg:py-56">
      <div class="text-center">
        <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">{{__('Want some company on events?')}}</h1>
        <p class="mt-8 text-lg font-medium text-pretty text-blue-200 sm:text-xl/8">{{__('On our website you can find people who want to join current events to team up and have fun together!')}}</p>
        <div class="hidden sm:mb-8 mt-5 sm:flex sm:justify-center">
          <div class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
            {{__('Register today and find your crew to events!<')}}</a>
          </div>
        </div>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="{{ route('page.login') }}" class="rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{__('Log in')}}</a>
          <a href="{{ route('page.register') }}" class="text-sm/6 font-semibold text-gray-900">{{__('Register now')}}<span aria-hidden="true">→</span></a>
        </div>
      </div>
    </div>
  </div>
</div>

@include('components.footer')

