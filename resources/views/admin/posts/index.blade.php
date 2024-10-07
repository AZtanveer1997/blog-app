@extends('layouts.app')

@section('content')
<h1>All Blog Posts</h1>
<form action="{{ route('admin.posts.search') }}" method="GET">
    <input type="text" name="search" placeholder="Search posts...">
    <button type="submit">Search</button>
</form>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>
                <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links() }}  <!-- Pagination links -->
@endsection
