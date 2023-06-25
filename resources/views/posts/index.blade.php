@extends('layouts.layoutadmin')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1>Create Post</h1>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select name="id_user" id="id_user" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id_user }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="picture" class="form-label">Input Cover Image</label>
                            <input class="form-control" type="file" id="picture" name="picture">
                        </div>
                        <!-- Add other post fields here -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1>Posts</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create
    </button>

    {{-- <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a> --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id_post }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>
                        <img src="{{ URL::asset($post->picture) }}" alt="..." class="" style="max-width: 200px">
                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
