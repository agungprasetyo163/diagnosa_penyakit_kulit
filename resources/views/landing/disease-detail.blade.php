@php

use Illuminate\Support\Str;

@endphp

@extends('layouts.landing')

@section('main-content')

<h2 class="h4 my-3">{{ $disease->name }}</h2>
<div class="row g-2">
    <div class="col-4">
        <img class=" w-100" src="/storage/diseases/{{ $disease->image }}" alt="">
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header text-primary"><strong>Deskripsi</strong></div>
            <div class="card-body">
                {{ $disease->description }}
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-primary"><strong>Penanganan</strong></div>
            <div class="card-body">{{ $disease->treatment }}</div>
        </div>
    </div>
</div>

@endsection