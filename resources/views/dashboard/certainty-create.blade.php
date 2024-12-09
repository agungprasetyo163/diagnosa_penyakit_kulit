@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Tingkat Keyakinan</h6>
                </div>
                <div class="card-body row">
                    <form action="{{ route('master.certainties.save') }}" method="POST" class="col-sm-12 col-md-6">
                        @csrf
                        <div class="form-group">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" id="label" name="label" required>
                        </div>
                        <div class="form-group">
                            <label for="score">Skor</label>
                            <input type="number" class="form-control" id="score" name="score" required step="any">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
