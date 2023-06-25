@extends('layouts.layoutadmin')

@section('content')
    <h1>Post Details</h1>

    <div>
        <strong>ID:</strong> {{ $post->id_post }}<br>
        <strong>Title:</strong> {{ $post->title }}<br>
        <strong>User:</strong> {{ $post->user->username }}<br>
        <img src="{{ URL::asset($post->picture) }}" alt="..." class="" style="max-width: 200px">
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
@endsection
