@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Supplier</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-info">Import Supplier</button>
                <a href="{{ url('/supplier/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Supplier</a>
                <a href="{{ url('/supplier/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Supplier</a>
                <button onclick="modalAction('{{ url('/supplier/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Filter Supplier</label>
                        <div class="col-4">
                            <select class="form-control filter_supplier" name="filter_supplier">
                                <option value="">- Semua -</option>
                                @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-sm table-striped table-hover" id="table-supplier">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
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

        var tableSupplier;
        $(document).ready(function() {
            // Inisialisasi DataTable dengan filter
            tableSupplier = $('#table-supplier').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('supplier/list') }}",
                    type: "POST",
                    data: function(d) {
                        d.filter_supplier = $('.filter_supplier').val(); // Menambahkan filter supplier
                    }
                },
                columns: [
                    { data: "supplier_id", className: "text-center", orderable: false, searchable: false },
                    { data: "supplier_kode", orderable: true, searchable: true },
                    { data: "supplier_nama", orderable: true, searchable: true },
                    { data: "supplier_alamat", orderable: true, searchable: true },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });

            // Event untuk melakukan filtering ketika filter_supplier diubah
            $('.filter_supplier').change(function() {
                tableSupplier.draw();
            });
        });
    </script>
@endpush
