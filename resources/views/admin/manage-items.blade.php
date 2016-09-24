@extends('layouts.admin')
@section('nav')
    @include('partials.nav')
@endsection

@section('content')
<div class="container" id="manage-items">

    <p class="lead">Manage items:</p>
    <p><a href="{{ url('/admin') }}">Back to admin area</a></p>

    <div class="row">
        <div class="col-md-12 row-padding">
            <div class="pull-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                    Create Item
                </button>
            </div>
        </div>
    </div>

    <!-- Item Listing -->
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th width="200px">Action</th>
        </tr>

        <tr v-for="item in items">
            <td>@{{ item.title }}</td>
            <td>@{{ item.description }}</td>
            <td>
                <button class="btn btn-primary" @click.prevent="editItem(item)">Edit</button>
                <button class="btn btn-danger" @click.prevent="deleteItem(item)">Delete</button>
            </td>
        </tr>
    </table>

    @include('partials.pagination')

    <!-- Create Item Modal -->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>

                    <h4 class="modal-title" id="myModalLabel">Create Item</h4>
                </div>
                <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" v-model="newItem.title"/>
                            <span v-if="formErrors['title']" class="error text-danger">@{{ formErrors['title'] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="title">Description:</label>
                            <textarea name="description" class="form-control" v-model="newItem.description"></textarea>
                            <span v-if="formErrors['description']" class="error text-danger">@{{ formErrors['description'] }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Item Modal -->
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                </div>

                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" v-model="fillItem.title"/>
                            <span v-if="formErrorsUpdate['title']" class="error text-danger">@{{ formErrorsUpdate['title'] }}</span>
                        </div>

                        <div class="form-group">
                            <label for="title">Description:</label>
                            <textarea name="description" class="form-control" v-model="fillItem.description"></textarea>

                            <span v-if="formErrorsUpdate['description']" class="error text-danger">@{{ formErrorsUpdate['description'] }}</span>
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