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
            if(this.query.length > 3) {
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