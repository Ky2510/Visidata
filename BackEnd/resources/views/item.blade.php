@extends('layouts.index')

@section('content')

<div class="row mt-2">
    <div class="col-lg-6">
        <h4>Daftar Barang</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">no</th>
                    <th scope="col">Barang</th>
                    <th scope="col">Item</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td scope="row">
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
    </div>
    <div class="col-lg-6">
        <div class="row">
            <h4>Form Pembelian Barang</h4>
            <form action="{{route('transaction.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="item_id" class="form-label">No Barang</label>
                    <input type="number" name="item_id" class="form-control @error('item_id') is-invalid @enderror"
                        value="{{ old('item_id') }}" placeholder="masukan no barang">
                    @error('item_id')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="quantity" class="form-label">No Barang</label>
                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity') }}" placeholder="masukan no barang">
                    @error('quantity')
                    {{ $message }}
                    @enderror
                </div>
                <button class="mt-2 btn btn-sm btn-primary" type="submit">Beli Sekarang</button> <br> <br>
            </form>
        </div>
    </div>
</div>

@endsection