<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-sm table-bordered">
        <tr>
            <th class="text-right col-4">Kode Penjualan :</th>
            <td class="col-8">{{ $data->penjualan_kode }}</td>
        </tr>
        <tr>
            <th class="text-right col-4">Pembeli :</th>
            <td class="col-8">{{ $data->pembeli }}</td>
        </tr>
        <tr>
            <th class="text-right col-4">Tanggal Penjualan :</th>
            <td class="col-8">{{ $data->penjualan_tanggal }}</td>
        </tr>
        <tr>
            <th class="text-right col-4">User :</th>
            <td class="col-8">{{ $data->user->nama }}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
</div>
