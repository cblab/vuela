@extends('layouts.admin')
@section('nav')
    @include('partials.nav')
@endsection

@section('content')
    <div class="container" id="manage-avatar">
        <form method="post" action="{{ route('store-avatar') }}" enctype="multipart/form-data">
            @include('partials.post-csrf')
            <label class="btn btn-default btn-file">
                Browse <input type="file" style="display: none;" name="avatar">
            </label>
            <button type="submit">Save Avatar</button>
        </form>
    </div>
@endsection

@section('footer')
    @include('partials.footer')
@endsection
