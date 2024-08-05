@extends('layouts.index')

@section('content')
Home <br>
{{ auth()->user()->name }}
<div class="row">
    <div class="col-lg-6">
        <div class="d-flex">
            <a class="btn btn-sm btn-primary" href="{{ route('item.index') }}">Beli Barang</a>
        </div>

        <div class="mt-2">
            <h4>Daftar Transaksi</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">barang</th>
                        <th scope="col">quantity</th>
                        <th scope="col">total</th>
                        <th scope="col">status</th>
                        <th scope="col">tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $item)
                    <tr>
                        <td scope="row">
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
        </div>
    </div>
</div>
@endsection