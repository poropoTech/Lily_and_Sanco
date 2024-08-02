/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');
require('../plugins');

require('../components/forms/avatar-selector');
require('../components/forms/img-selector');

require('../components/frontend/activity/activity-card');
require('../components/frontend/category/category-card');

require('../components/frontend/response/response-new-modal');
require('../components/frontend/response/response-new-modal-imgs');
require('../components/frontend/response/response-new-modal-text');
require('../components/frontend/response/response-new-modal-file');
require('../components/frontend/response/response-new-modal-autosubmit');
require('../components/frontend/response/response-like');
require('../components/frontend/response/response-publish');
require('../components/frontend/response/response-delete');
require('../components/frontend/response/response-comment');
require('../components/frontend/response/response-comment-publish');
require('../components/frontend/response/response-comment-delete');
require('../components/frontend/response/response-comment-modal');
require('../components/frontend/response/response-comment-inline');
require('../components/frontend/response/response-card');

require('./pages/main');
require('./pages/wall');
require('./pages/activity');
require('./pages/category');
require('./pages/user/challenges');



import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
