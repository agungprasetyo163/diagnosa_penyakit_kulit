@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Prediksi Penyakit Kulit') }}</h1>
    
    <div class="card">
        <div class="p-4 row w-100">
            <div class="col-6 d-flex flex-column justify-content-center">
                <p class="h4 mb-4">Hasil Diagnosa</p>
                <p>Jenis penyakit yang diderita adalah,</p>
                <p class="h2 font-weight-bolder">
                    <span class="text-primary">{{ $results[0]['name'] }}</span> / {{ $results[0]['percentage'] }}%
                </p>
            </div>
            <div class="col-6">
                <img src="/storage/diseases/{{ $results[0]['image'] }}" alt="penyakit" class="w-100">
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header"><span class="text-primary font-weight-bold">Detail</span></div>
        <div class="card-body">
            <div class="p-2">
                {{ $results[0]['description'] }}
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header"><span class="text-primary font-weight-bold">Saran Penanganan</span></div>
        <div class="card-body">
            <div class="p-2">
                {{ $results[0]['treatment'] }}
            </div>
        </div>
    </div>
        
    <div class="card mt-2">
        <div class="card-header"><span class="text-primary font-weight-bold">Kemungkinan Lain</span></div>
        <div class="card-body">
            <div class="p-2">
                @foreach ($results as $i => $result)
                    @if ($i != 0)
                        <div class="row mb-2">
                            <p class="">{{ $result['name'] }} / {{ $result['percentage'] }}%</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- <div class="row">

        <!-- Content Column -->
        <div class="col-12 mb-4">
            @foreach ($results as $result)
                <div class="row mb-2">
                    <div class="col-8 bg-primary m-auto d-flex justify-content-between align-items-center text-white py-3 px-4">
                        <p class="mb-0 h3 font-weight-bold">{{ $result['name'] }}</p>
                        <p class="mb-0 font-weight-bolder h4">{{ $result['percentage'] }}%</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
@endsection
