<x-app-layout>
    <div class="w-11/12 md:w-4/5 lg:w-3/4 mx-auto text-center mt-5">
        <div id="video-list" class="flex flex-wrap gap-4 md:gap-5">
            @foreach ($videos as $video)
                <x-watched-card :video="$video"/>
            @endforeach
        </div>
        <div class="mt-5 right-0">
            {{ $videos->links() }}
        </div>
    </div>
</x-app-layout>
