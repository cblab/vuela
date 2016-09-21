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
    'backend' :          asset_js_path.path + 'vue/pages/backend/',
    'frontend' :         asset_js_path.path + 'vue/pages/frontend/'
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
            asset_js_path.path      + "/app.js"
        ], './resources/assets/js/temp/frontend-app.js').webpack('./resources/assets/js/temp/frontend-app.js');
});

/* executing  gulp should look like this frontend-app.js and admin-app.js are intermediate compilements now.
   They should not be modified as they are used as basis for babel later on.
   I just wanted a seperation of frontend and backend js files.
┌───────────────┬───────────────────────────────┬───────────────────────────────────────────────────────────────────┬───────────────────────────────────────┐
│ Task          │ Summary                       │ Source Files                                                      │ Destination                           │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.sass()    │ 1. Compiling Sass             │ resources/assets/sass/frontend.scss                               │ public/css/frontend.css               │
│               │ 2. Autoprefixing CSS          │                                                                   │                                       │
│               │ 3. Concatenating Files        │                                                                   │                                       │
│               │ 4. Writing Source Maps        │                                                                   │                                       │
│               │ 5. Saving to Destination      │                                                                   │                                       │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.copy()    │ 1. Saving to Destination      │ ./bower_components/bootstrap-sass/assets/fonts/...                │ public/fonts                          │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.scripts() │ 1. Concatenating Files        │ ./bower_components/jquery/dist/jquery.js                          │ ./resources/assets/js/frontend-app.js │
│               │ 2. Writing Source Maps        │ ./bower_components/html5shiv/dist/html5shiv.js                    │                                       │
│               │ 3. Saving to Destination      │ ./bower_components/vue/dist/vue.js                                │                                       │
│               │                               │ ./bower_components/lodash/dist/lodash.core.js                     │                                       │
│               │                               │ ./bower_components/vue-resource/dist/vue-resource.js              │                                       │
│               │                               │ ./resources/assets/js/app.js                                      │                                       │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.webpack() │ 1. Transforming ES2015 to ES5 │ resources/assets/js/frontend-app.js                               │ public/js/frontend-app.js             │
│               │ 2. Writing Source Maps        │                                                                   │                                       │
│               │ 3. Saving to Destination      │                                                                   │                                       │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.sass()    │ 1. Compiling Sass             │ resources/assets/sass/backend.scss                                │ public/css/backend.css                │
│               │ 2. Autoprefixing CSS          │                                                                   │                                       │
│               │ 3. Concatenating Files        │                                                                   │                                       │
│               │ 4. Writing Source Maps        │                                                                   │                                       │
│               │ 5. Saving to Destination      │                                                                   │                                       │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.copy()    │ 1. Saving to Destination      │ ./bower_components/bootstrap-sass/assets/fonts/bootstrap/...      │ public/fonts                          │
├───────────────┼───────────────────────────────┼───────────────────────────────────────────────────────────────────┼───────────────────────────────────────┤
│ mix.scripts() │ 1. Concatenating Files        │ ./bower_components/jquery/dist/jquery.js                          │ public/js/backend.js                  │
│               │ 2. Writing Source Maps        │ ./bower_components/html5shiv/dist/html5shiv.js                    │                                       │
│               │ 3. Saving to Destination      │ ./bower_components/bootstrap-sass/assets/javascripts/bootstrap.js │                                       │
└───────────────┴───────────────────────────────┴───────────────────────────────────────────────────────────────────┴───────────────────────────────────────┘

the js console in chrome should look like this:
 >> window._
 <- function lodash()
 >> window.$
 <- function jQuery()
 >> window.Vue
 <- function Vue()
*/

/** admin */
elixir(mix => {
    mix.sass(["admin.scss"], 'public/css/admin.css')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .scripts([
            paths.jquery            + "dist/jquery.js",
            paths.html5shiv         + "dist/html5shiv.js",
            paths.vue               + "dist/vue.js",
            paths.lodash            + "dist/lodash.core.js",
            paths.vueresource       + "dist/vue-resource.js",
            asset_js_path.path      + "/admin-app.js"
        ], './resources/assets/js/temp/admin-app.js').webpack('./resources/assets/js/temp/admin-app.js')
});