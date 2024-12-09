@php

use Illuminate\Support\Str;

@endphp

@extends('layouts.landing')

@section('main-content')

<div class="container">
    <h2 class="h4 my-3">Info Penyakit</h2>
    <div class="row">
        @foreach ($diseases as $disease)
            <div class="col-3 p-2">
                <div class="card">
                    <img class="card-img-top" src="/storage/diseases/{{ $disease['image'] }}" alt="Card image" style="width: 100%; max-height: 200px; object-fit: cover">
                    <div class="card-body">
                        <h4 class="card-title text-primary font-weight-bold">{{ $disease['name'] }}</h4>
                        <p class="card-text">{{ Str::limit($disease['description'], 100, '...') }}</p>
                        <a href="{{ route('landing.disease-info.detail', ['disease' => $disease['id']]) }}" class="btn btn-primary btn-sm">Selengkapnya</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection