@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pengetahuan</h6>
                </div>
                <div class="card-body row">
                    <form action="{{ route('master.knowledges.store') }}" method="POST" class="col-sm-12 col-md-6" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="d-block">Nama Penyakit</label>
                            <select class="form-control" name='name' id='name' required>
                                <option selected>Pilih penyakit</option>
                                @foreach ($diseases as $disease)
                                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p>Gejala</p>
                        <div class="mb-2 p-2" style="height: 300px; overflow-y: auto">
                            @foreach ($symptoms as $symptom)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="symptom-{{ $symptom->id }}" id="symptom-{{ $symptom->id }}">
                                    <label class="form-check-label" for="symptom-{{ $symptom->id }}">
                                        {{ $symptom->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
