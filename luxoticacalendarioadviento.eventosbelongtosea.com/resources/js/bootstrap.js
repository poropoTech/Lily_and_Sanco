window._ = require('lodash');
window.Swal = require('sweetalert2');
window.Cropper = require('cropperjs');
window.InView = require('in-view');
// window.Isotope = require('isotope-layout');




/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');



    require('bootstrap');
    require('emojionearea');
    require('bootstrap4-toggle');
    require('bootstrap-datepicker');
    require('bootstrap-select');

    window.jQueryBridget = require('jquery-bridget');
    window.InfiniteScroll = require('infinite-scroll');
    jQueryBridget( 'infiniteScroll', InfiniteScroll, $ );

    window.LoadingIO = require('@loadingio/loading-bar');




} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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

function customObserver(target,config,callback){
    this.target =target|| document;
    this.config = config||{childList:true, subtree:true};
    var that=this;
    this.ob = new MutationObserver(function(mut,observer){
        callback.call(that,mut,observer);
    });
}

customObserver.prototype={
    connect:function(){
        this.ob.observe(this.target,this.config);
    },
    disconnect:function(){ this.ob.disconnect()}
};

window.CustObs = customObserver;


