new Vue({
    el: 'body',
    template: '#tasks-search-template',
    data: function () {
        return {
            tasks: []
        };
    },
    ready : function(){
        this.search('lorem');
    },

    methods : {
        search: function(query){
            $.getJSON('/task-search?query='+query, function(tasks) {
                this.tasks = tasks;
            }.bind(this));
        }
    }
});