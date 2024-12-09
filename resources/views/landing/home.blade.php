@extends('layouts.landing')

@section('main-content')

<div class="jumbotron mb-0" style="min-height: 80vh; background-image: url('{{asset('img/landing_banner.jpg')}}'); background-repeat: no-repeat; background-size: cover;">
    <h1 class="display-4 mt-5">Sistem Pakar Penyakit Kulit</h1>
    <p class="lead">Sistem pakar penyakit kulit adalah sistem prediksi penyakit kulit dengan menginputkan gejala-gejala yang anda alami.</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{ Auth::check() ? route('home') : route('login') }}" role="button">Coba Sekarang</a>
    </p>
</div>

{{-- <img style="height: 540px; object-fit: cover;" src="{{ asset('img/landing_banner.jpg') }}" class="w-100" /> --}}

@endsection