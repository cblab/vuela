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
    <tasks></tasks>
</div>

<template id="tasks-template">
    <h1>task list</h1>
    <p><a href="{{url('/') }}">search-test-page</a></p>
    <ul class="list-group">
        <li class="list-group-item" v-for="task in list">
            @{{ task.description }}
        </li>
    </ul>
</template>

<script src="js/frontend-app.js"></script>
</body>
</html>