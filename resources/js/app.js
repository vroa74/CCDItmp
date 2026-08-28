import { initFlowbite } from 'flowbite';
import { createIcons, icons } from 'lucide';

window.addEventListener('DOMContentLoaded', () => {
    initFlowbite();
    createIcons({
        icons,
        attrs: {
            class: 'inline-block',
        },
    });
});