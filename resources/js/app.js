import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

import './bootstrap';
import { createApp } from 'vue' 
import ChatBox from './components/ChatBox.vue'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false
});

createApp({}) 
    .component('chat-box', ChatBox)
    .mount('#app')