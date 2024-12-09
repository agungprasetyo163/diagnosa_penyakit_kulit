@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Penyakit</h6>
                </div>
                <div class="card-body row">
                    <form action="{{ route('master.diseases.save') }}" method="POST" class="col-sm-12 col-md-6" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Penyakit</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="treatment">Penanganan</label>
                            <textarea class="form-control" id="treatment" name="treatment" required rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png" required>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
