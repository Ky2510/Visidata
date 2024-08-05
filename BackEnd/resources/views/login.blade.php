@extends('layouts.index')

@section('content')
<h2>Halaman Login</h2>
<form action="{{ route('login.store') }}" method="POST">
    @csrf
    <input type="text" name="email" placeholder="email">
    @error('email')
    <span style="text-danger">{{ $message }}</span>
    @enderror
    <input type="password" name="password" placeholder="password">
    <button type="submit">
        Simpan
    </button>
</form>

<a href="{{ route('register') }}">Register</a>
@endsection