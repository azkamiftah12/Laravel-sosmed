<!-- resources/views/users/create.blade.php -->

@extends('layouts.layoutadmin')

@section('content')
    <h1>Create User</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nohp">Nomor Handphone:</label>
            <input type="text" name="nohp" id="nohp" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_role">select role</label>
            <select name="id_role" id="id_role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
