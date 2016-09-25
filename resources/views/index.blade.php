<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Application</title>
    <link href="css/frontend.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-2"><p><a href="{{url('/admin') }}">admin area</a></p></div>
        <div class="col-md-2"><p><a href="{{url('/list-all') }}">list all tasks</a></p></div>
        <div class="col-md-8">&nbsp;</div>
    </div>
</div>

<div class="container">
    <search-tasks></search-tasks>
</div>

<template id="tasks-search-template">
    <div class="row">
        <div class="col-md-12">
                <h2>Search Tasks</h2>
                <p>(for example search 'ipsum' - new tasks can be created in the admin area)</p>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1">@My tasks:</span>
                    <input type="text" class="form-control" placeholder="enter task terms" aria-describedby="sizing-addon1" v-model="query" v-on:keyup="search" debouce="500">
                </div>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered"  v-if="tasks.length > 0">
                <tr>
                    <th>Task description:</th>
                </tr>

                <tr v-for="task in tasks">
                    <td>@{{ task.description }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<script src="js/frontend-app.js"></script>
</body>
</html>


