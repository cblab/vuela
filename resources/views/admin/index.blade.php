@extends('layouts.admin')
@section('nav')
    @include('partials.nav')
@endsection

@section('content')
<div class="container">
    <h2 class="sub-header">Admin Area</h2>
    <p class="lead">Welcome, <mark>{{ Auth::user()->name }}</mark>:</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Things to manage:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="{{route('manage-avatar') }}">Upload an avatar image</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{route('manage-tasks') }}">Manage Tasks</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{route('manage-items') }}">Manage Items</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection


@section('footer')
    @include('partials.footer')
@endsection