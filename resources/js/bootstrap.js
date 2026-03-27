import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.interceptors.request.use(function (config) {
    let lang = document.querySelector('meta[name="language"]')?.getAttribute('content') || 'ar';
    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    config.headers['lang'] = lang;
    if (csrfToken) {
        config.headers['X-CSRF-TOKEN'] = csrfToken;
    }
    return config;
});



/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

// import './echo';
