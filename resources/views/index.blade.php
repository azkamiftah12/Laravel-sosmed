@extends('layouts.app')

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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create
    </button>

    <div class="row">
        @forelse ($posts as $post)
            <div class="col-lg-3 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ URL::asset($post->picture) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span class="badge rounded-pill bg-info text-dark">{{ $post->user->username }}</span>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's
                            content.</p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
            </div>
        @empty
            <h1>
                No posts found.
            </h1>
        @endforelse
    </div>
@endsection
