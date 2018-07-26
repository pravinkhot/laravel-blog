@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2>View Post</h2>

    <form method="post" action="#" id="viewBlogPostForm">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $blogPostDetail->name }}" disabled="">
        </div>
        <div class="form-group">
            <label for="email">Name</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"  disabled="">{{ $blogPostDetail->description }}</textarea>
        </div>
        <a class="btn btn-secondary" href="{{ route('blogPost.index') }}">Cancel</a>
    </form>
@endsection