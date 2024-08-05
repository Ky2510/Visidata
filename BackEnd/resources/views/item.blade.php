@extends('layouts.index')

@section('content')
Home <br>
Hello {{ auth()->user()->name }}
<br><br>

Daftar Barang
<table>
    <thead>
        <tr>
            <th>no</th>
            <th>barang</th>
            <th>quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $item->name }}
            </td>
            <td>
                Rp. {{ $item->price }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{route('transaction.store')}}" method="post">
    @csrf
    <br> <label>masukan no barang</label> <br>
    <input type="number" name="item_id">
    <br> <label>masukan jumlah</label> <br>
    <input type="number" name="quantity"><br>
    <button type="submit">Beli</button> <br> <br>
</form>
@endsection