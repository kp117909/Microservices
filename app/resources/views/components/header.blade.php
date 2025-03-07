<header class="absolute inset-x-0 top-0 z-50 ">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:flex-1">
        <a href="{{route('page.welcome')}}" class="-m-1.5 p-1.5">
          <span class="sr-only">VibesSync™</span>
          <img class="h-24 w-auto" src="{{ Vite::asset('resources/imgs/logo_main.png') }}" alt="">
        </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="#" class="text-sm/6 font-semibold text-gray-500 hover:text-gray-900 hover:underline">Events</a>
        <a href="{{route('page.welcome')}}" class="text-sm/6 font-semibold text-gray-500 hover:text-gray-900 hover:underline">Home</a>
        <a href="#" class="text-sm/6 font-semibold text-gray-500 hover:text-gray-900 hover:underline">People</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="{{ route('page.login') }}" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    </div>
  </header>