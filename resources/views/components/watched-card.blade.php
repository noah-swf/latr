@props(['video'])

<div class="bg-white rounded-lg shadow-md lg:p-3 p-2 text-left w-full md:w-[calc(50%-12px)] lg:w-[calc(25%-15px)]">
    <div class="flex items-center flex-col">
        <!-- Image & mobile button -->
        <div class="flex-shrink-0 w-full relative">
            <a href="{{ $video->url }}" target="_blank">
                <img class="h-32 max-md:min-h-40 w-full object-cover rounded-md opacity-65" src="{{ $video->thumbnail }}" alt="Laravel Course Thumbnail">
            </a>
        </div>
        <!-- Text & desktop button -->
        <div class="flex-grow max-md:flex-shrink-0 min-w-0 pl-0 mt-2 w-full relative">
            <a href="{{ $video->url }}" target="_blank" class="mt-1 block text-sm leading-tight font-semibold text-black">
                {{ $video->title }}
            </a>
            <div class="flex justify-between items-center mt-2">
                <x-tag>{{ $video->platform }}</x-tag>

                <div class="flex sm:items-center">
                    <x-dropdown width="56" class="relative">
                        <x-slot name="trigger">
                            <button class="p-1 rounded-full hover:bg-gray-200 focus:outline-none transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <circle cx="10" cy="5" r="1.75" />
                                    <circle cx="10" cy="10" r="1.75" />
                                    <circle cx="10" cy="15" r="1.75" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link type="button" data-id="{{ $video->id }}" class="toggle-watched-trigger hover:cursor-pointer {{ $video->watched ? 'watched' : '' }}" >
                                {{ __('Als ungesehen markieren') }}
                            </x-dropdown-link>

                            <x-dropdown-link type="button" data-id="{{ $video->id }}" class="delete-trigger hover:cursor-pointer text-red-600">
                                Löschen
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-watched-trigger').forEach(el => {
        // Deckt sowohl die Checkbox als auch den Button ab
        el.addEventListener('click', () => {
            const videoId = el.getAttribute('data-id');
            const videoList = document.getElementById('video-list');
            const isWatched = el.classList.contains('watched');

            const body = isWatched ? {
                unwatched: false,
                video_id: videoId
            } : {
                video_id: videoId
            };

            // Findet die WatchLaterCard (ausgehend vom Button/Checkbox) anhand der Klassen
            const videoCard = el.closest('.bg-white.rounded-lg');

            fetch(`/watch-later/toggle-watched/${videoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify(body)
            })
            .then(response => response.json())
            .then(data => {
                if(data && data.success) {
                    // Ausblenden der Karte mit Animation
                    videoCard.style.transition = 'opacity 0.3s, transform 0.3s';
                    videoCard.style.opacity = '0';
                    videoCard.style.transform = 'translateY(-20px)';

                    // Nach der Animation das Element entfernen
                    setTimeout(() => {
                        videoCard.remove();
                    }, 300);
                } else {
                    console.log("Fehler beim Togglen");
                }
            })
            .catch(error => {
                console.error('Fehler beim Togglen:', error);
            });
        });
    });

    document.querySelectorAll('.delete-trigger').forEach(el => {
            el.addEventListener('click', () => {
                const videoId = el.getAttribute('data-id');
                const videoCard = el.closest('.bg-white.rounded-lg');

                fetch(`/watch-later/${videoId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data && data.success) {
                        // Gleiche Animation wie beim toggle-watched
                        videoCard.style.transition = 'opacity 0.3s, transform 0.3s';
                        videoCard.style.opacity = '0';
                        videoCard.style.transform = 'translateY(-20px)';

                        // Nach der Animation das Element entfernen
                        setTimeout(() => {
                            videoCard.remove();
                        }, 300);
                    } else {
                        console.log("Fehler beim Löschen");
                    }
                })
                .catch(error => {
                    console.error('Fehler beim Löschen:', error);
                });
            });
        });
    });
</script>
