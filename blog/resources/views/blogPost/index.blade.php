@extends('layouts.app')

@section('title', 'Blog List')

@section('content')
    <h2>Post List</h2>
	<a class="btn btn-primary" href="{{ route('blogPost.create') }}">Add Post</a>

	@if (session('successMessage'))
	    <div class="alert alert-success">
	        {{ session('successMessage') }}
	    </div>
	@endif

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if(count($blogPostList))
				@foreach($blogPostList as $post)
					<tr>
				        <td>{{ $post->blog_id }}</td>
				        <td>{{ $post->name }}</td>
				        <td>{{ $post->description }}</td>
				        <td>
				        	<form method="post" action="{{ route('blogPost.destroy', ['blog_id' => $post->blog_id]) }}" id="deleteBlogPostForm">
				        		<a class="btn btn-info" href="{{ route('blogPost.show', ['blog_id' => $post->blog_id]) }}">View</a>
				        		@if ($post->role_id == Auth::user()->role_id)
					        		<a class="btn btn-primary" href="{{ route('blogPost.edit', ['blog_id' => $post->blog_id]) }}">Edit</a>
					        		{{ csrf_field() }}
	        						@method('DELETE')
	        						<button type="submit" class="btn btn-danger">Delete</button>
				        		@endif
				        	</form>
				        </td>
				    </tr>
				@endforeach
			@else
				<tr>
			        <td colspan="4" class="text-center">No record found.</td>
			    </tr>
			@endif
		</tbody>
	</table>
@endsection