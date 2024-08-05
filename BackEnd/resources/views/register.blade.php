@extends('layouts.index')

@section('content')
<h2>Halaman Register</h2>
<div class="row">
    <div class="col-lg-6">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="name">
                @error('name')
                <span style="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="email">
                @error('email')
                <span style="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-sm btn-primary mt-2">
                Register
            </button>
            <a href="{{route('login')}}">Login</a>
        </form>
    </div>
</div>
@endsection