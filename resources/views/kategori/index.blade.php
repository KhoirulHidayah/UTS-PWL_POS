@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kategori</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kategori/import') }}')" class="btn btn-info">Import Kategori</button>
                <a href="{{ url('/kategori/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Kategori</a>
                <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Kategori</a>
                <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
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
                        <label class="col-2 control-label col-form-label">Filter Kategori</label>
                        <div class="col-4">
                            <select class="form-control filter_kategori" name="filter_kategori">
                                <option value="">- Semua -</option>
                                @foreach ($kategori as $kategori)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-sm table-striped table-hover" id="table-kategori">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false"
        data-width="75%"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableKategori;
        $(document).ready(function() {
            // Inisialisasi DataTable dengan filter
            tableKategori = $('#table-kategori').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('kategori/list') }}",
                    type: "POST",
                    data: function(d) {
                        d.filter_kategori = $('.filter_kategori').val(); // Mengirim filter ke server
                    }
                },
                columns: [
                    { data: "kategori_id", className: "text-center", orderable: false, searchable: false },
                    { data: "kategori_kode", orderable: true, searchable: true },
                    { data: "kategori_nama", orderable: true, searchable: true },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });

            // Event untuk filtering
            $('.filter_kategori').change(function() {
                tableKategori.draw(); // Memuat ulang DataTable dengan filter
            });
        });
    </script>
@endpush
