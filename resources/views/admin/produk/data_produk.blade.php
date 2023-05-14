@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Product</div>

                    <div class="card-body">
                        <a class="btn btn-success" href="{{ url('input_data_product') }}"> Input Data</a>
                        <a class="btn btn-primary" href="{{ url('home') }}"> Kembali</a>
                        <br> <br>

                        @if ($message = Session::get('succes'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Product Code</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Currency</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Dimension</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Action</th>
                            </tr>
                            @foreach ($data_produk as $item)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->currency }}</td>
                                    <td>{{ $item->discount }}</td>
                                    <td>{{ $item->dimension }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td class="text-center">

                                        <a class="btn btn-primary btn-sm"
                                            href="/edit_data_product_admin/{{ $item->id_product }}">Edit</a>

                                        <a class="btn btn-danger btn-sm"
                                            href="/hapus_data_product_admin/{{ $item->id_product }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {!! $data_produk->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
