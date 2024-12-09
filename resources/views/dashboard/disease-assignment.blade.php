@extends('layouts.admin')

@php

function symptomExists(array $diseaseSymptoms, string $symptomId): bool {
    foreach ($diseaseSymptoms as $ds) {
        if ($ds['symptom_id'] == $symptomId) {
            return true;
        }
    }

    return false;
}

@endphp

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Prediksi Penyakit Kulit') }}</h1>

    <div class="row">

        <!-- Content Column -->
        <div class="col-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Assign</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('master.assignments.store', ['diseaseId' => $disease['id']]) }}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="p-2"></td>
                                    @foreach ($certainties as $certainty)
                                        <td class="p-2 text-center">{{ $certainty['label'] }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($symptoms as $symptom)
                                    <tr>
                                        <td class="p-2" style="min-width: 150px">{{ $symptom['name'] }}</td>
                                        @foreach ($certainties as $certainty)
                                            <td class="p-2 text-center">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="{{ $symptom['id'] }}"
                                                    value="{{ $certainty['id'] }}"
                                                    @if ($loop->index == 0)
                                                        checked
                                                    @endif
                                                    @foreach($disease['disease_symptoms'] as $ds)
                                                        @if ($ds['symptom_id'] == $symptom['id'] && $ds['certainty_id'] == $certainty['id'])
                                                            checked
                                                        @endif
                                                    @endforeach
                                                    />
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
