import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('themeHandler', () => ({
        theme: localStorage.getItem('theme') || 'skalsa',
        init() {
            document.documentElement.setAttribute('data-theme', this.theme);
        },
        toggleTheme() {
            this.theme = this.theme === 'skalsa' ? 'skalsa-dark' : 'skalsa';
            document.documentElement.setAttribute('data-theme', this.theme);
            localStorage.setItem('theme', this.theme);
        },
    }));
});

Alpine.start();
