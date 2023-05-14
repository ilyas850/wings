@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ url('confirmasi_checkout') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="col-md-12">
                        <div class="card-body">
                            @foreach ($checkout_data as $item)
                                <div class="row p-2 bg-white border rounded">
                                    <div class="col-md-3">
                                        <img class="img-fluid img-responsive rounded product-image"
                                            src="{{ asset('images/product.jpg') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="product_code[]" value="{{ $item->product_code }}">
                                        <h5>{{ $item->product_name }}</h5>
                                        <div class="d-flex flex-row">
                                            <h5 class="mr-1">{{ $item->quantity }} {{ $item->unit }}</h5>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <h5 class="mr-1">Subtotal : {{ __('Rp. ') }}
                                                {{ number_format($item->sub_total, 0, ',', '.') }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <center>
                            <h3 class="mr-1 border rounded">TOTAL : {{ __('Rp. ') }}
                                {{ number_format($total, 0, ',', '.') }}
                            </h3>
                        </center>
                    </div>
                    <input type="hidden" name="total" value="{{ $total }}">
                    <button type="submit" class="btn btn-info">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        body {
            background: #eee
        }

        .ratings i {
            font-size: 16px;
            color: red
        }

        .strike-text {
            color: red;
            text-decoration: line-through
        }

        .product-image {
            width: 60%
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-left: 6px;
            margin-right: 6px;
            margin-top: 3px;
            background-color: blue;
            border-radius: 50%;
            display: inline-block
        }

        .spec-1 {
            color: #938787;
            font-size: 15px
        }

        h5 {
            font-weight: 400
        }

        .para {
            font-size: 16px
        }
    </style>
@endsection
