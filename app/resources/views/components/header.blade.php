<header class="absolute inset-x-0 top-0 z-50 ">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:flex-1">
        <a href="{{route('page.welcome')}}" class="-m-1.5 p-1.5">
          <span class="sr-only">VibesSync™</span>
        </a>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="{{route('page.events')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">Events</a>
        <a href="{{route('page.welcome')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">Home</a>
        <a href="{{route('page.users_list')}}" class="text-m/6 font-semibold text-blue-100 hover:text-gray-900 hover:underline">People</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="{{ route('page.login') }}" class="text-xl/6 font-semibold text-blue-100 hover:underline">Log in <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>
    </div>
  </header>

  <header class="absolute inset-x-0 top-0 z-50 ">

<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <!-- Logo -->
    <a href="{{ route('page.welcome') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ Vite::asset('resources/images/logo_main_no.png') }}" class="h-8" alt="VibesSync Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">VibesSync</span>
    </a>

    <!-- Buttons -->
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <!-- Mobile hamburger -->
      <button id="mobile-toggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <!-- Navigation -->
  <div class="hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
  <ul class="flex flex-col md:flex-row md:space-x-8 rtl:space-x-reverse p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 w-full">
    
    <li>
      <a href="{{ route('page.events') }}" class="block py-2 px-3 text-gray-900 dark:text-white md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500">Events</a>
    </li>
    <li>
      <a href="{{ route('page.welcome') }}" class="block py-2 px-3 text-gray-900 dark:text-white md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">Home</a>
    </li>
    <li>
      <a href="{{ route('page.users_list') }}" class="block py-2 px-3 text-gray-900 dark:text-white md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500">People</a>
    </li>
    <li class="md:ml-auto mt-2 md:mt-0">
      <a href="{{ route('page.login') }}" class="block py-2 px-3 text-white bg-blue-700 hover:underline rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500">
        {{ __('Log in') }} <span aria-hidden="true">&rarr;</span>
      </a>
    </li>

  </ul>
</div>

  </div>
</nav>



    
</header>