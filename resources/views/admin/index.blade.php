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
                    <a href="{{route('manage-items') }}">Mange Items</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{route('manage-tasks') }}">Mange Tasks</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection


@section('footer')
    @include('partials.footer')
@endsection