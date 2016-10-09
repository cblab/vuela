require('laravel-elixir-vue');

var gulp       = require('gulp');
var elixir     = require('laravel-elixir');
var vendor          = { 'path' : './bower_components'};
var asset_js_path   = { 'path' : './resources/assets/js' };

var paths = {
    'jquery':            vendor.path + '/jquery/',
    'bootstrap':         vendor.path + '/bootstrap-sass/assets/',
    'css3_mediaqueries': vendor.path + '/css3-mediaqueries-js/',
    'html5shiv' :        vendor.path + '/html5shiv/',
    'lodash':            vendor.path +'/lodash/',
    'vue' :              vendor.path + '/vue/',
    'vueresource':       vendor.path + '/vue-resource/',
    'bootstrap_select':  vendor.path + '/bootstrap-select/'
};

/** frontend */
elixir(mix => {
    mix.sass(["frontend.scss"], 'public/css/frontend.css')
       .copy(paths.bootstrap + 'fonts/**', 'public/fonts')
       .scripts([
            paths.jquery            + "dist/jquery.js",
            paths.html5shiv         + "dist/html5shiv.js",
            paths.vue               + "dist/vue.js",
            paths.lodash            + "dist/lodash.core.js",
            paths.vueresource       + "dist/vue-resource.js",
            asset_js_path.path      + "/app.js",
            asset_js_path.path      + "/get-tasks.js",
            asset_js_path.path      + "/search-tasks.js",
        ], './resources/assets/js/temp/frontend-app.js').webpack('./resources/assets/js/temp/frontend-app.js');
});

/** admin */
elixir(mix => {
    mix.sass(["admin.scss",
               paths.bootstrap_select  + 'dist/css/bootstrap-select.css'], 'public/css/admin.css')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .scripts([
            paths.jquery            + "dist/jquery.js",
            paths.html5shiv         + "dist/html5shiv.js",
            paths.vue               + "dist/vue.js",
            paths.lodash            + "dist/lodash.core.js",
            paths.vueresource       + "dist/vue-resource.js",
            paths.bootstrap_select  + "dist/js/bootstrap-select.js",
            asset_js_path.path      + "/admin-app.js",
            asset_js_path.path      + "/get-avatar.js",
            asset_js_path.path      + "/manage-items.js",
            asset_js_path.path      + "/manage-tasks.js",
        ], './resources/assets/js/temp/admin-app.js').webpack('./resources/assets/js/temp/admin-app.js')
});