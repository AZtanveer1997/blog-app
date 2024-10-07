@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">All Blog Posts</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 text-end">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>

        <!-- Admin Panel Button - only shown for admins -->
        @if(auth()->user()->isAdmin()) 
            <a href="{{ route('admin.index') }}" class="btn btn-secondary ms-2 float-left">Go to Admin Panel</a>
        @endif
    </div>


    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request()->input('search') }}">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->description, 50) }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid" style="max-height: 100px; object-fit: cover;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $posts->links() }} <!-- Pagination links -->
</div>
@endsection
