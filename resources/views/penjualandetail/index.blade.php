@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Penjualan</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/penjualandetail/import') }}')" class="btn btn-info">Import Detail Penjualan</button>
                <a href="{{ url('/penjualandetail/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Detail Penjualan</a>
                <a href="{{ url('/penjualandetail/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Detail Penjualan</a>
                <button onclick="modalAction('{{ url('/penjualandetail/create_ajax') }}')" class="btn btn-success">Tambah Data
                    (Ajax)</button>
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
                        <label class="col-1 control-label col-form-label">Filter</label>
                        <div class="col-3">
                            <select class="form-control" id="penjualan_id" name="penjualan_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($penjualans as $penjualan)
                                    <option value="{{ $penjualan->penjualan_id }}">{{ $penjualan->penjualan_id }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih Penjualan</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualandetail">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penjualan ID</th>
                        <th>Barang ID</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = ''){
        $('#myModal').load(url, function(){
            $('#myModal').modal('show');
        });
    }

    var dataPenjualanDetail;
    $(document).ready(function(){
        dataPenjualanDetail = $('#table_penjualandetail').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('penjualandetail/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function (d){
                    d.penjualan_id = $('#penjualan_id').val(); // filter berdasarkan penjualan_id
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
                    data: "penjualan_id", // ID penjualan
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_id", // ID barang
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga",
                    className: "text-center",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        // Format the price as Rupiah
                        return 'Rp ' + data.toLocaleString('id-ID');
                    }
                },
                {
                    data: "jumlah", // Jumlah
                    className: "text-center",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#penjualan_id').on('change', function() {
            dataPenjualanDetail.ajax.reload(); // Memuat ulang data saat filter berubah
        });
    });
</script>
@endpush
