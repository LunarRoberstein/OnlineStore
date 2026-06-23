@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 text-center">
                <h1>Selamat Datang di Bulan's Store</h1>
                <p class="lead">Temukan produk terbaik pilihan kami!</p>
                <a href="{{ route('product.index') }}" class="btn btn-success mt-3">
                    Lihat Produk
                </a>
            </div>
        </div>
    </div>
@endsection
