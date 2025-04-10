<x-app-layout>
    <div class="w-1/2 max-md:w-4/5 mx-auto text-center">
        <h1 class="font-lora italic font-medium text-5xl opacity-85 py-24">Save it now. Watch it latr.</h1>

        <x-main-text-input/>
        
        <div>
            @foreach ($videos as $video)
                <x-watch-later-card :video="$video"/>
            @endforeach
        </div>
        

    </div>
</x-app-layout>
