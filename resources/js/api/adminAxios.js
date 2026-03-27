import axios from "axios";
import Cookies from "js-cookie";



const webApi = axios.create({
    baseURL: `${window.location.origin}/api/`
});

webApi.interceptors.request.use(
    function (config) {
        let lang = document.querySelector('meta[name="language"]')?.getAttribute('content') || 'ar';
        let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        config.headers['lang'] = lang;
        config.headers['Accept-Language'] = lang;
        if (csrfToken) {
            config.headers['X-CSRF-TOKEN'] = csrfToken;
        }
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

webApi.defaults.headers.common['Accept'] = 'application/json';
webApi.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

webApi.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (401 === error.response.status) {
        location.href = '/login';
    } else {
        return Promise.reject(error);
    }
});
// end axios
export default webApi;
