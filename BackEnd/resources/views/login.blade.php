@extends('layouts.index')

@section('content')
<h2>Halaman Login</h2>
<div class="row">
    <div class="col-lg-6">

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="email">
            </div>
            @error('email')
            <span style="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label for="passoword" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <button class="btn btn-sm btn-primary mt-2" type="submit">
                Masuk
            </button>
            <a href="{{ route('register') }}">Register</a>
        </form>
    </div>
</div>

@endsection