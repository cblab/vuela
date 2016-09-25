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