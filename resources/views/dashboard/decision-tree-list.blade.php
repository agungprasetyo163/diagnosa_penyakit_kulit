@php

use App\Helper\C45;

@endphp

@extends('layouts.admin')

@section('main-content')

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">C4.5 Tree</h6>
                </div>
                <div class="card-body">
                    <a data-toggle="collapse" href="#perhitungan">Detail Perhitungan</a>
                    <pre class="collapse" id="perhitungan"><?php
                                                            $c45 = new C45($dataset, $gejalas, 'PENYAKIT', true);
                                                            ?></pre>
                </div>
                <div class="card-body">
                    {{ $c45->display() }}
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .c45_tree {
            margin: 0;
            padding: 0;
        }
    
        .c45_tree li {
            list-style: none;
        }
    
        .c45_tree ul li {
            margin: 10px;
            position: relative;
        }
    
        .c45_tree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 2px solid black;
            border-bottom: 2px solid black;
            border-radius: 0 0 0 0;
            width: 20px;
            height: 20px;
        }
    
        .c45_tree li::after {
            position: absolute;
            content: "";
            top: 8px;
            left: -20px;
            border-left: 2px solid black;
            border-top: 2px solid black;
            border-radius: 0 0 0 0;
            width: 20px;
            height: 100%;
        }
    
        .c45_tree a {
            min-width: 80px;
        }
    
        .c45_tree li:last-child::after {
            display: none
        }
    
        .c45_tree li:last-child:before {
            border-radius: 0 0 0 5px
        }
    
        ul.c45_tree>li:first-child::before {
            display: none
        }
    </style>

    <script>
        var datatable

        function openDeleteModal(id) {
            $('#myModal').modal('show');
        }
        
        $(document).ready(function () {
            datatable = $('#datatable').DataTable({
                language: {
                    search: 'Cari',
                    searchPlaceholder: 'Cari di pohon keputusan'
                },
                processing: true,
                serverSide: true,
                ajax: '/decision-tree/ajax-datatable',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: "symptom.name" },
                    { data: "symptom.category" },
                    { data: "disease.name" },
                ]
            });
        });
    </script>

@endsection
