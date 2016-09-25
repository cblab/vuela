/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
next();
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
//Vue.component('tasks', require('./components/tasks.vue'));
Vue.component('tasks', {
    template: '#tasks-template',
    data: function () {
        return {
            list: []
        };
    },
    created: function () {
        $.getJSON('/latest-tasks', function(tasks) {
           this.list = tasks;
        }.bind(this));
    }
});

Vue.component('search-tasks', {
    template: '#tasks-search-template',
    data: function () {
        return {
            query:'',
            tasks: []
        }
    },
    ready : function(){
        //this.query='lorem';
        //this.search();
    },
    methods : {
        search: function(){
            if(tasks.length > 3) {
                $.getJSON('/task-search?query='+this.query, function(tasks) {
                    this.tasks = tasks;
                }.bind(this));
            }
        }
    }
});

new Vue({
    el: 'body'
});
