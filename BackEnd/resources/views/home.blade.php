@extends('layouts.index')

@section('content')
Home <br>
Hello {{ auth()->user()->name }}
<br><br>
<a href="{{ route('item.index') }}">Beli Barang</a>
<table>
    <thead>
        <tr>
            <th>no</th>
            <th>barang</th>
            <th>quantity</th>
            <th>total</th>
            <th>status</th>
            <th>tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $item)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $item->item->name }}
            </td>
            <td>
                {{ $item->quantity }}
            </td>
            <td>
                Rp. {{ $item->total }}
            </td>
            <td>
                {{ $item->status }}
            </td>
            <td>
                {{ $item->created_at->format('d-m-Y') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection