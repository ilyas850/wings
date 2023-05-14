@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Data Product</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Edit gagal.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/update_data_product/{{ $data_produk->id_product }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Product Code</strong>
                                        <input type="text" name="product_code" class="form-control"
                                            placeholder="Product Code" value="{{ $data_produk->product_code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Product Name</strong>
                                        <input type="text" name="product_name" class="form-control"
                                            placeholder="Product Name" value="{{ $data_produk->product_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Price</strong>
                                        <input class="form-control" name="price" placeholder="Price"
                                            value="{{ $data_produk->price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Currency</strong>
                                        <input class="form-control" name="currency" placeholder="Currency"
                                            value="{{ $data_produk->currency }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Discount</strong>
                                        <input class="form-control" name="discount" placeholder="Discount"
                                            value="{{ $data_produk->discount }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Dimension</strong>
                                        <input class="form-control" name="dimension" placeholder="Dimension"
                                            value="{{ $data_produk->dimension }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Unit</strong>
                                        <input class="form-control" name="unit" placeholder="Unit"
                                            value="{{ $data_produk->unit }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    <a href="{{ url('data_produk_admin') }}" class="btn btn-primary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
