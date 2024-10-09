@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter Kode:</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="filter_kode" placeholder="Masukkan Kode Kategori">
                    </div>
                    <label class="col-1 control-label col-form-label">Filter Nama:</label>
                    <div class="col-3">
                        <input type="text" class="form-control" id="filter_nama" placeholder="Masukkan Nama Kategori">
                    </div>
                </div>
            </div>
        </div>        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data kategori akan ditambahkan di sini menggunakan DataTables -->
            </tbody>
        </table>
    </div>    
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var dataKategori = $('#table_kategori').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('kategori/list') }}",
                dataType: "json",
                type: "POST",
                data: function(d){
                    d.kategori_kode = $('#filter_kode').val();
                    d.kategori_nama = $('#filter_nama').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kategori_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Reload data ketika filter diubah
        $('#filter_kode, #filter_nama').on('keyup change', function(){
            dataKategori.ajax.reload();
        });
    });
</script>
@endpush
