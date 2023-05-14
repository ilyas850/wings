@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('succes'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row p-2 bg-white border rounded">
                    <div class="col-md-4 mt-1"><img class="img-fluid img-responsive rounded product-image"
                            src="{{ asset('images/product.jpg') }}"></div>
                    <div class="col-md-7 mt-1">
                        <h2>{{ $item->product_name }}</h2>
                        <div class="d-flex flex-row">
                            <span class="strike-text">{{ __('Rp. ') }}
                                {{ number_format($item->price, 0, ',', '.') }}</span>
                            <br>
                        </div>
                        <div class="d-flex flex-row">
                            <h4 class="mr-1">{{ __('Rp. ') }}
                                {{ number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="text-justify text-truncate para mb-0">Dimension : {{ $item->dimension }}</p>
                        </div>
                        <div class="d-flex flex-row">
                            <p class="text-justify text-truncate para mb-0">Price Unit : {{ $item->unit }}</p>
                        </div>
                        <div class="d-flex flex-column mt-4">
                            {{-- <button class="btn btn-primary btn-sm" type="button">Buy</button> --}}
                            <a href="/buy_product/{{ $item->id_product }}" class="btn btn-primary btn-sm">Buy</a>
                        </div>
                    </div>
                </div>
            </div>
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
            width: 100%
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
