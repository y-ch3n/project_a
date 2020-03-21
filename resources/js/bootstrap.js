window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
import env from './env';
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = env.app_domain+env.api_url;
let token = localStorage.getItem('accessToken');
if (token) {
    window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
}

let swal2 = require('sweetalert2');

window.swal = {
    loading() {
        return swal2.fire({
            title: 'Loading',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                swal2.showLoading();
            }
        });
    },
    success(message = "", title = "Success") {
        return swal2.fire({
            title: title,
            text: message,
            icon: 'success',
            timer: 1500,
            showConfirmButton:false
        })
    },
    error(message = "Something went wrong", title = "Opps...") {
        return swal2.fire({
            title: title,
            text: message,
            icon: 'error'
        });
    }
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
