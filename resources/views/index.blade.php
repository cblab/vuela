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
    <search-tasks></search-tasks>
</div>

<template id="tasks-search-template">
    <h4>Search Tasks</h4>
    <p>(press enter after input, for example 'ipsum' - new tasks can be created in the admin area)</p>
    <input type="text" v-model="query" v-on:keyup="search" debouce="500">

    <div class="table-responsive">
        <table class="table table-bordered"  v-if="tasks.length > 0">
            <tr>
                <th>task description</th>
            </tr>

            <tr v-for="task in tasks">
                <td>@{{ task.description }}</td>
            </tr>
        </table>
    </div>
    <p><a href="{{url('/list-all') }}">back to list-test-page</a></p>
</template>

<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<script src="js/frontend-app.js"></script>
</body>
</html>


