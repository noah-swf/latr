<x-app-layout>
    <div class="w-1/2 max-md:w-4/5 mx-auto text-center">
        <h1 class="font-lora italic font-medium text-5xl opacity-85 py-24">Save it now. Watch it latr.</h1>

        <x-main-text-input/>

        <div id="video-list">
            @foreach ($videos as $video)
                <x-watch-later-card :video="$video"/>
            @endforeach
        </div>

        <div class="mt-5">
            {{ $videos->links() }}
        </div>


    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const saveButton = document.getElementById('save-button');
        const videoUrlInput = document.getElementById('video-url');
        const videoList = document.getElementById('video-list');

        saveButton.addEventListener('click', function() {
            const url = videoUrlInput.value.trim();

            if (!url) {
                return;
            }

            // Button-Status auf "Lädt..." setzen
            saveButton.disabled = true;
            saveButton.querySelector('span').textContent = 'Speichern...';

            // Formular-Daten erstellen
            const formData = new FormData();
            formData.append('url', url);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            // AJAX-Request senden
            fetch('/watch-later/store', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    videoUrlInput.value = ''; // Input-Feld leeren

                    videoList.insertAdjacentHTML('afterbegin', data.html);
                }
            })
            .catch(error => {
                console.error('Fehler:', error);
            })
            .finally(() => {
                // Button-Status zurücksetzen
                saveButton.disabled = false;
                saveButton.querySelector('span').textContent = 'Speichern';
            });
        });

    });


    </script>
