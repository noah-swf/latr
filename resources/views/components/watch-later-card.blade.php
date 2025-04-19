@props(['video'])


    <div class="mx-auto bg-white rounded-lg shadow-md overflow-hidden mt-5 lg:p-3 p-2 text-left">
        <div class="flex items-center max-md:flex-col ">
            <!-- Image & mobile button -->
            <div class="flex-shrink-0 max-md:w-full relative ">
                <div class="p-2 absolute hidden max-md:block top-0 right-0">
                    <button
                        type="button"
                        data-id="{{ $video->id }}"
                        class="toggle-watched-trigger flex items-center bg-primary/50 hover:bg-primary text-white text-sm font-medium px-2 py-2 rounded-lg transition flex-shrink-0 z-99 {{ $video->watched ? 'watched' : '' }}">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                        </svg>
                    </button>
                </div>
                <a href="{{ $video->url }}" target="_blank" ><img class="h-24 w-44 max-md:w-full max-md:h-44 object-cover rounded-md" src="{{ $video->thumbnail }}" alt="Laravel Course Thumbnail"></a>
            </div>
            <!-- Text & desktop button -->
                <a href="{{ $video->url }}" target="_blank" class="flex-grow max-md:flex-shrink-0 min-w-0 pl-4 max-md:pl-0 max-md:my-2 max-md:w-full relative">
                    <x-tag>{{ $video->platform }}</x-tag>
                    <h3 class="mt-1 block text-sm leading-tight font-semibold text-black">
                        {{ $video->title }}
                    </h3>
                    <p class="mt-1 text-gray-500 text-xs truncate ">
                        {{ $video->url }}
                    </p>
                </a>
            <div class="flex-shrink-0 p-3 max-md:hidden">
                <input type="checkbox" data-id="{{ $video->id }}"  {{ $video->watched ? 'checked' : '' }} class="toggle-watched-trigger h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary hover:cursor-pointer">
            </div>
        </div>
    </div>
