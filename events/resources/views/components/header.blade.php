<header class="absolute inset-x-0 top-0 z-50 ">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:flex-1">
        <a href="{{route('page.welcome')}}" class="-m-1.5 p-1.5">
          <span class="sr-only">VibesSync™</span>
        </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="{{route('page.events')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">Events</a>
        @auth
          <a href="{{route('page.dashboard')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">Home</a>
        @else
          <a href="{{route('page.welcome')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">Home</a>
        @endauth
        <a href="#" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">People</a>
      </div>
      @auth
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="{{ route('ext.logout') }}" class="text-xl/6 font-semibold text-blue-100 hover:underline">{{__('Logout')}} {{auth()->user()->name}}<span aria-hidden="true">&rarr;</span></a>
      <div>
      @else
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="{{ route('page.login') }}" class="text-xl/6 font-semibold text-blue-100 hover:underline">{{__('Log in')}} <span aria-hidden="true">&rarr;</span></a>
      </div>
      @endauth
    </nav>
    </div>
  </header>