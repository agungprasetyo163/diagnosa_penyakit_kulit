@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Prediksi Penyakit Kulit') }}</h1>

    <div class="row">

        <!-- Content Column -->
        <div class="col-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Prediksi</h6>
                </div>
                <div class="card-body" style="overflow-x: auto">
                    <form action="/prediction/result">
                        <table class="table">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                @foreach ($symptoms as $symptom)
                                    <tr>
                                        <td class="d-flex justify-content-between">
                                            <p class="mb-0 mr-2">{{ $symptom['name'] }}</p>
                                            <select class="form-control flex-shrink-0" style="width: 200px" id="{{ $symptom['id'] }}" name="{{ $symptom['id'] }}">
                                                @foreach ($certainties as $certainty)
                                                    <option value="{{ $certainty['score'] }}">{{ $certainty['label'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <table class="table">
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
                                                    value="{{ $certainty['score'] }}"
                                                    @if ($loop->index == 0)
                                                        checked
                                                    @endif
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
