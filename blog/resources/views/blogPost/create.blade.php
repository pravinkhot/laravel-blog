@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2>Add Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('blogPost.store') }}" id="addBlogPostForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Name</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection