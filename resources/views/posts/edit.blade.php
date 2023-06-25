@extends('layouts.layoutadmin')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="form-group">
            <label for="id_user">User</label>
            <select name="id_user" id="id_user" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id_user }}" @if ($user->id_user === $post->id_user) selected @endif>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="picture" class="form-label">Input Cover Image</label>
            <input class="form-control" type="file" id="picture" name="picture">
        </div>

        <!-- Add other post fields here -->

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
