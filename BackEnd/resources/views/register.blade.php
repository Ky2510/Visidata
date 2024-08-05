@extends('layouts.index')

@section('content')
<h2>Halaman Register</h2>
<form action="{{ route('register.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="name">
    @error('name')
    <span style="text-danger">{{ $message }}</span>
    @enderror
    <input type="email" name="email" placeholder="email">
    @error('email')
    <span style="text-danger">{{ $message }}</span>
    @enderror
    <input type="password" name="password" placeholder="password">
    <button type="submit">
        Simpan
    </button>
</form>
@endsection