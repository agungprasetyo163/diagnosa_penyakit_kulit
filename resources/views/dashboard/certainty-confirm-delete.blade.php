@extends('layouts.admin')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ingin Hapus Tingkat Keyakinan?</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">Tingkat keyakinan yang sudah dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="card-footer">
                    <form
                        action="{{ route('master.certainties.delete', ['certainty' => $id]) }}"
                        method="POST"
                        class="d-flex justify-content-end"
                    >
                        @csrf
                        <a role="button" href="{{ route('master.certainties.list') }}" class="btn btn-secondary">Tidak</a>
                        <button class="btn btn-primary ml-2" type="submit">Ya</button>
                    </form>
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
                ajax: '/symptoms/ajax-datatable',
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { 
                        "data": null, 
                        "render": function(data, type, full, meta){
                            return '<a role="button" class="btn btn-danger" href="/symptoms/' + full.id + '/delete">Hapus</a>';
                        }
                    }
                ]
            });
        });
    </script>

@endsection
