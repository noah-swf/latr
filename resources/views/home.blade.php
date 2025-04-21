<x-app-layout>
    <div class="w-1/2 max-md:w-4/5 mx-auto text-center">
        <h1 class="font-lora italic font-medium text-5xl opacity-85 py-24">Save it now. Watch it latr.</h1>

        <x-main-text-input/>

        <div id="video-list">
            @foreach ($videos as $video)
                <x-watch-later-card :video="$video"/>
            @endforeach
        </div>

        <div class="mt-5 right-0">
            {{ $videos->links() }}
        </div>
        @if ($videos->isEmpty())
            <div class="w-full py-32">
                <h2 class="text-xl font-bold text-gray-700 opacity-50">Deine Liste ist noch leer.</h2>
                <p class="text-gray-500 mt-1 opacity-50">  Füge spannende Videos hinzu, um sie später hier anzusehen!</p>
            </div>

        @endif

    </div>
</x-app-layout>
