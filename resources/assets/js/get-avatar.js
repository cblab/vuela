Vue.component('avatar', {
    template: '#avatar-template',
    data: function () {
        return {
            avatarurl: ''
        };
    },
    ready: function () {
        console.log('getAvatars called');
        this.getAvatars();
    },
    methods : {
        getAvatars: function() {
            $.getJSON('/get-avatar', function(avatarurl) {
                this.avatarurl = avatarurl;
            }.bind(this));
        }
    }
});

new Vue({
    el: '#avatar'
});