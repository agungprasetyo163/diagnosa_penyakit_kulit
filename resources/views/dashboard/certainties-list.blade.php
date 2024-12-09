@extends('layouts.admin')

@section('main-content')

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-left-success alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Tingkat Keyakinan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-2">
                        <a role="button" href="{{ route('master.certainties.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Label</th>
                                <th>Skor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certainties as $certainty)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $certainty['label'] }}</td>
                                <td>{{ $certainty['score'] }}</td>
                                <td class="d-flex">
                                    <a role='button' class='btn btn-warning mr-2' href='{{ route('master.certainties.edit', ['certainty' => $certainty['id'] ]) }}'>Edit</a>
                                    <a role='button' class='btn btn-danger' href='{{ route('master.certainties.confirm-delete', ['id' => $certainty['id'] ]) }}'>Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
