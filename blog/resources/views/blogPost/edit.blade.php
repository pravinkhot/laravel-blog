@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h2>Edit Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('blogPost.update', ['blog_id' => $blogID]) }}" id="editBlogPostForm">
        {{ csrf_field() }}
        @method('PUT')
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $blogPostDetail->name }}">
        </div>
        <div class="form-group">
            <label for="email">Name</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description">{{ $blogPostDetail->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection