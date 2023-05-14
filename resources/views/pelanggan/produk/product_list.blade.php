@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('succes'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ url('product_list') }}" class="btn btn-info">Product List</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('checkout_page') }}" class="btn btn-success">Checkout
                                    {{ $jml_checkout }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            @foreach ($data_produk as $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-2 bg-white border rounded">
                                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                        src="{{ asset('images/product.jpg') }}"></div>
                                <div class="col-md-6 mt-1">
                                    <h5>{{ $item->product_name }}</h5>
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
                                    {{-- <div class="d-flex flex-row">
                                    <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                                </div>
                                <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span
                                        class="dot"></span><span>Light
                                        weight</span><span class="dot"></span><span>Best finish<br></span></div>
                                <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span
                                        class="dot"></span><span>For
                                        men</span><span class="dot"></span><span>Casual<br></span></div> --}}

                                </div>
                                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                    {{-- <div class="d-flex flex-row align-items-center">
                                    <h4 class="mr-1">{{ __('Rp. ') }}
                                        {{ number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }}
                                    </h4>
                                    <span class="strike-text">{{ __('Rp. ') }}
                                        {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div> --}}

                                    <div class="d-flex flex-column mt-4">
                                        <a href="/detail_product/{{ $item->id_product }}"
                                            class="btn btn-primary btn-sm">Details</a>
                                        <a href="/buy_product/{{ $item->id_product }}"
                                            class="btn btn-outline-primary btn-sm mt-2">Buy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <hr>
            {!! $data_produk->links() !!}
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
