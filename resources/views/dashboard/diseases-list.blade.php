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
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary d-flex align-items-center" onclick="showLoadingSpinner()">
                            <div class="spinner-border spinner-border-sm mr-2 d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Data Mining
                        </button>
                        <a role="button" href="{{ route('master.diseases.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div style="overflow-x: auto">
                        <table id="datatable" class="table table-striped dataTable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Penanganan</th>
                                    <th>Gambar</th>
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
    </div>

    <script>
        function showLoadingSpinner() {
            document.querySelector('.spinner-border').classList.remove('d-none')
            document.querySelector('.spinner-border').classList.add('d-block')
            
            setTimeout(() => {
                document.querySelector('.spinner-border').classList.remove('d-block')
                document.querySelector('.spinner-border').classList.add('d-none')

                Swal.fire({
                    icon: 'success',
                    title: 'Data Mining Berhasil!',
                }).then((result) => {
                    window.location.href = '/decision-tree'
                })
            }, 7000);
        }
    </script>

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
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "treatment" },
                    { 
                        "data": null, 
                        "render": function(data, type, full, meta){
                            return "<img src='/storage/diseases/" + data.image + "' style='max-width: 200px' />";
                        },
                        "searchable": false,
                        "sortable": false,
                    },
                    { 
                        "data": null, 
                        "render": function(data, type, full, meta){
                            return "<div class='d-flex'><a role='button' class='btn btn-warning mr-2' href='/diseases/" + full.id + "/edit'>Edit</a><a role='button' class='btn btn-danger' href='/diseases/" + full.id + "/delete'>Hapus</a></div>";
                        },
                        "searchable": false,
                        "sortable": false,
                    }
                ]
            });
        });
    </script>

@endsection
