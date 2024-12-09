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
                    <h6 class="m-0 font-weight-bold text-primary">List Penyakit</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-2">
                        <a role="button" href="{{ route('master.diseases.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var datatable

        function openDeleteModal(id) {
            $('#myModal').modal('show');
        }
        
        $(document).ready(function () {
            datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/diseases/ajax-datatable',
                "columns": [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { "data": "name" },
                    { 
                        "data": null, 
                        "render": function(data, type, full, meta){
                            return "<div class='d-flex'><a role='button' class='btn btn-primary mr-2' href='/assignments/" + full.id + "'>Assign</a></div>";
                        },
                        "searchable": false,
                        "sortable": false,
                    }
                ]
            });
        });
    </script>

@endsection
