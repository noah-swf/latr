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
    <div class="w-11/12 md:w-4/5 lg:w-3/4 lg:h-[calc(100vh-11rem)] h-[calc(100vh-5rem)] mx-auto text-center flex flex-col items-center justify-center">
        @if ($videos->isEmpty())
        <div class="w-full">
            <h2 class="text-2xl font-bold text-gray-700">Noch keine Videos angesehen?</h2>
            <p class="text-gray-500 mt-2"> Hake Videos von deiner Watch-Later-Liste ab, und du findest sie hier jederzeit wieder.</p>
        </div>
    @endif
    </div>
</x-app-layout>
