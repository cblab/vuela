@extends('layouts.admin')
@section('nav')
    @include('partials.nav')
@endsection

@section('content')
    <div class="container" id="manage-tasks">

        <p class="lead">Manage tasks:</p>
        <p><a href="{{ url('/admin') }}">Back to admin area</a></p>

        <div class="row">
            <div class="col-md-12 row-padding">
                <div class="pull-right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-task">
                        Create Task
                    </button>
                </div>
            </div>
        </div>

        <!-- Task Listing -->
        <table class="table table-bordered">
            <tr>
                <th>task description</th>
                <th>Is task completed</th>
                <th width="200px">Action</th>
            </tr>

            <tr v-for="task in tasks">
                <td>@{{ task.description }}</td>
                <td>@{{ task.completed }}</td>
                <td>
                    <button class="btn btn-primary" @click.prevent="editTask(task)">Edit</button>
                    <button class="btn btn-danger" @click.prevent="deleteTask(task)">Delete</button>
                </td>
            </tr>
        </table>

    @include('partials.pagination')

    <!-- Create Task Modal -->
        <div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>

                        <h4 class="modal-title" id="myModalLabel">Create Task</h4>
                    </div>
                    <div class="modal-body">

                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createTask">
                            <div class="form-group">
                                <label for="title">task description:</label>
                                <input type="text" name="description" class="form-control" v-model="newTask.description"/>
                                <span v-if="formErrors['description']" class="error text-danger">@{{ formErrors['description'] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="title">completed:</label>
                                <select class="selectpicker" v-model="newTask.completed">
                                    <option v-for="option in options" v-bind:value="option.value">
                                        @{{ option.text }}
                                    </option>
                                </select>
                                <span v-if="formErrors['completed']" class="error text-danger">@{{ formErrors['completed'] }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div class="modal fade" id="edit-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                        <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
                    </div>

                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateTask(fillTask.id)">

                            <div class="form-group">
                                <label for="title">description:</label>
                                <input type="text" name="description" class="form-control" v-model="fillTask.description"/>
                                <span v-if="formErrorsUpdate['description']" class="error text-danger">@{{ formErrorsUpdate['description'] }}</span>
                            </div>

                            <div class="form-group">
                                <label for="title">Completed:</label>

                                <select class="selectpicker" v-model="fillTask.completed">
                                    <option v-for="option in options" v-bind:value="option.value">
                                        @{{ option.text }}
                                    </option>
                                </select>

                                <span v-if="formErrorsUpdate['completed']" class="error text-danger">@{{ formErrorsUpdate['completed'] }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection