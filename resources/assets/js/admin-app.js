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

//Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 *
 * Could not figure out how this works yet. Using a gulp workaraound.
 */
//Vue.component('manage-items', require('./components/admin/manage-vue.vue'));
new Vue({
    el: '#manage-vue',
    data: {
        items: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newItem : {'title':'','description':''},
        fillItem : {'title':'','description':'','id':''}
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;

        },

        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;

            if (from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);

            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];

            while (from <= to) {
                pagesArray.push(from);
                from++;
            }

            return pagesArray;

        }
    },

    ready : function(){
        this.getVueItems(this.pagination.current_page);
    },


    methods : {
        getVueItems: function(page){
            this.$http.get('/items?page='+page).then((response) => {
                this.$set('items', response.data.data.data);
            this.$set('pagination', response.data.pagination);
        });
        },


        createItem: function(){
            var input = this.newItem;
            this.$http.post('/items',input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.newItem = {'title':'','description':''};

            $("#create-item").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrors = response.data;
            });
        },

        deleteItem: function(item){
            this.$http.delete('/items/'+item.id).then((response) => {
                this.changePage(this.pagination.current_page);
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        });
        },


        editItem: function(item){
            this.fillItem.title = item.title;
            this.fillItem.id    = item.id;
            this.fillItem.description = item.description;
            $("#edit-item").modal('show');
        },

        updateItem: function(id){
            var input = this.fillItem;
            this.$http.put('/items/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.fillItem = {'title':'','description':'','id':''};

            $("#edit-item").modal('hide');
            toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        }
    }
});