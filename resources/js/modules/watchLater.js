const WatchLater = {
    init() {
        this.setupGlobalEventListeners();
        this.setupVideoAddForm();
    },

    setupGlobalEventListeners() {
        // Event für Toggle-Watched Buttons
        document.body.addEventListener('click', (event) => {


            const toggleButton = event.target.closest('.toggle-watched-trigger');
            if (toggleButton && toggleButton.tagName !== 'INPUT') {
                this.handleToggleWatched(toggleButton);
            }

            const deleteButton = event.target.closest('.delete-trigger');
            console.log(deleteButton);
            if(deleteButton){
                this.handleDeleteVideo(deleteButton);
                return;
            }
        });

        // Event für Toggle-Watched Checkboxes
        document.body.addEventListener('change', (event) => {
            const toggleCheckbox = event.target.closest('.toggle-watched-trigger');
            if (toggleCheckbox && toggleCheckbox.tagName === 'INPUT') {
                this.handleToggleWatched(toggleCheckbox);
            }
        });
    },

    setupVideoAddForm() {
        const saveButton = document.getElementById('save-button');
        const videoUrlInput = document.getElementById('video-url');
        const videoList = document.getElementById('video-list');

        // Überprüfen, ob die Elemente existieren
        if (!saveButton || !videoUrlInput || !videoList) return;

        saveButton.addEventListener('click', () => {
            const url = videoUrlInput.value.trim();
            if (!url) return;

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
    },

    handleToggleWatched(el) {
        const videoId = el.getAttribute('data-id');

        // Findet die WatchLaterCard anhand der Klassen
        const videoCard = el.closest('.bg-white.rounded-lg');
        if (!videoCard) return;

        fetch(`/watch-later/toggle-watched/${videoId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.getCsrfToken(),
            },
            body: JSON.stringify({
                video_id: videoId
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data && data.success) {
                this.animateAndRemoveCard(videoCard);
            } else {
                console.log("Fehler beim Togglen");
            }
        })
        .catch(error => {
            console.error('Fehler beim Togglen:', error);
        });
    },

    handleDeleteVideo(el) {
        const videoId = el.getAttribute('data-id');
        const videoCard = el.closest('.bg-white.rounded-lg');

        console.log(videoCard);

        if (!videoCard) return;

        // Bestätigungsdialog
        if (!confirm('Möchtest du dieses Video wirklich löschen?')) {
            return;
        }

        fetch(`/watch-later/${videoId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.getCsrfToken(),
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data && data.success) {
                this.animateAndRemoveCard(videoCard);
            } else {
                console.log("Fehler beim Löschen");
            }
        })
        .catch(error => {
            console.error('Fehler beim Löschen:', error);
        });
    },

    animateAndRemoveCard(videoCard) {
        // Animationslogik für das Entfernen eines Elements
        videoCard.style.transition = 'opacity 0.3s, transform 0.3s';
        videoCard.style.opacity = '0';
        videoCard.style.transform = 'translateY(-20px)'; // Konsistente Animation für alle Karten

        // Nach der Animation das Element entfernen
        setTimeout(() => {
            videoCard.remove();
        }, 300);
    },

    getCsrfToken() {
        // Versuche zuerst das Meta-Tag
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (metaToken) return metaToken.getAttribute('content');

        // Alternativ verstecktes Eingabefeld
        const inputToken = document.querySelector('input[name="_token"]');
        if (inputToken) return inputToken.value;

        // Falls nichts gefunden wurde
        console.error('CSRF-Token nicht gefunden. Bitte fügen Sie ein Meta-Tag oder verstecktes Eingabefeld hinzu.');
        return '';
    }


};

export default WatchLater;
