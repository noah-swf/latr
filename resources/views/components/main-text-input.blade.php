@php
    $classes = "flex items-center w-full rounded-lg overflow-hidden bg-white shadow-sm mt-5"
@endphp

<div {{ $attributes->merge(['class' => $classes])}}>
    <form class="flex items-center w-full" id="video-form" method="POST" action="/watch-later/store">
        @csrf
        <input
            type="text"
            id="video-url"
            placeholder="Füge einen Link zu einem Video, Film oder einer Serie hinzu"
            class="flex-grow text-sm placeholder-gray-400 focus:outline-none focus:ring-0 px-4 py-2 border-none min-w-0 "
        />
        <button
            id="save-button"
            type="submit"
            class="flex items-center gap-1 bg-primary hover:bg-primary text-white text-sm font-medium px-4 py-2 rounded-lg transition flex-shrink-0 ">
        <span class="whitespace-nowrap"> Speichern </span>
        <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" >
            <path d="M200-120v-640q0-33 23.5-56.5T280-840h400q33 0 56.5 23.5T760-760v640L480-240 200-120Zm80-122 200-86 200 86v-518H280v518Zm0-518h400-400Z"/>
        </svg>
        </button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const saveButton = document.getElementById('save-button');
        const videoUrlInput = document.getElementById('video-url');

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
                }
            })
            .catch(error => {
                showMessage('Ein Fehler ist aufgetreten: ' + error.message, 'error');
            })
            .finally(() => {
                // Button-Status zurücksetzen
                saveButton.disabled = false;
                saveButton.querySelector('span').textContent = 'Speichern';
            });
        });

    });
    </script>
