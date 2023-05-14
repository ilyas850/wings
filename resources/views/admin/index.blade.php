@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Selamat Datang Admin') }}

                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ url('data_produk_admin') }}" class="btn btn-info">Data Produk</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ url('data_produk_admin') }}" class="btn btn-success">Detail Transaksi</a>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ url('report_penjualan') }}" class="btn btn-danger">Report Penjualan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
