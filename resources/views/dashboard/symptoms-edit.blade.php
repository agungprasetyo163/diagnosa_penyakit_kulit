@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Gejala</h6>
                </div>
                <div class="card-body row">
                    <form action="{{ route('master.symptoms.update', ['symptom' => $symptom['id']]) }}" method="POST" class="col-sm-12 col-md-6">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Gejala</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ $symptom['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" name="code" required value="{{ $symptom['code'] }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" required value="{{ $symptom['category'] }}">
                        <button class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
