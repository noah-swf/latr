import './bootstrap';

import WatchLater from './modules/watchLater';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialisierung der Listener und Funktionen
document.addEventListener('DOMContentLoaded', () => {
    WatchLater.init();
});

import.meta.glob([
    '../images/**'
  ]);
