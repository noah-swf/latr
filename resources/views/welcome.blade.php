<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Im head-Tag deiner Layout-Datei -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-neutral">
        <div class="min-h-screen ">
            <nav>
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-14 lg:py-6">
                    <div class="flex justify-between h-16">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>
                        <!-- Account -->
                        <form action="{{ route('profile.edit') }}" method="GET">


                            <div class="flex items-center ms-6">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-primary focus:outline-none transition ease-in-out duration-150">
                                    <div class="transition duration-150 ease-in-out">
                                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" >
                                            <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="relative mx-auto px-4 sm:px-6 lg:px-14 mt-8 lg:mt-16 lg:h-[calc(100vh-11rem)] h-[calc(100vh-5rem)] overflow-hidden">
                <!-- Mockup -->
                <div class="absolute bottom-0 right-0 pointer-events-none">
                  <img
                    src="{{ Vite::asset('/images/device-mockup.png') }}"
                    alt="latr app mockup"
                    class="lg:w-auto max-w-full"
                    onerror="this.src='https://placehold.co/600x400?text=latr+App+Mockup'"
                  />
                </div>

                <!-- Content -->
                <div
                  class="flex flex-col items-center justify-center -mt-10
                         md:flex-row md:justify-between
                         h-full relative z-10"
                >
                  <div class="w-full lg:w-1/2 md:w-4/5 px-4 lg:px-0">  <!-- auf Mobile volle Breite mit Padding -->
                    <h1 class="font-lora italic text-4xl md:text-5xl leading-tight mb-6">
                      Behalte deine Watchlist im Griff – immer und überall.
                    </h1>
                    <p class="text-lg mb-8 text-gray-700">
                      Organisiere Videos, Filme und Serien an einem Ort und schaue sie, wenn du Zeit hast.
                    </p>
                    <form action="{{ route('home') }}" method="GET">
                        @csrf
                        <x-primary-button>
                            Jetzt loslegen
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                          </x-primary-button>
                    </form>

                  </div>
                </div>
              </div>




        </div>
        <x-footer class="mt-0"/>
    </body>
</html>
