<?php

namespace App\Http\Controllers;

use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PenjualanDetailController extends Controller
{
    // Menampilkan halaman awal detail penjualan
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Daftar Detail Penjualan'
        ];

        $activeMenu = 'penjualandetail'; // set menu yang sedang aktif

        $penjualans =PenjualanModel::all();
        return view('penjualandetail.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'penjualans' => $penjualans
        ]);
    }

    // Ambil data detail penjualan dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $details = PenjualanDetailModel::with(['penjualan', 'barang']); // Mengambil data detail penjualan dengan relasi

        $penjualans = $request->input('penjualan_id');
           // Apply filter based on penjualan_id
        if ($penjualans) {
            $details->where('penjualan_id', $penjualans);
        }
        return DataTables::of($details)
            ->addIndexColumn() // Menambahkan kolom index / no urut
            ->addColumn('aksi', function ($detail) { // Menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\'' . url('/penjualandetail/' . $detail->detail_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualandetail/' . $detail->detail_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualandetail/' . $detail->detail_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Kolom aksi adalah HTML
            ->make(true);
    }

    // Menampilkan halaman form tambah detail penjualan
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah detail penjualan baru'
        ];

        $activeMenu = 'penjualandetail'; // set menu yang sedang aktif
        $penjualans = PenjualanModel::all(); // Ambil data penjualan
        $barangs = BarangModel::all(); // Ambil data barang

        return view('penjualandetail.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'penjualans' => $penjualans,
            'barangs' => $barangs
        ]);
    }

    // Menyimpan data detail penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        PenjualanDetailModel::create($request->all());

        return redirect('/penjualandetail')->with('success', 'Data detail penjualan berhasil disimpan');
    }

    // Menampilkan detail penjualan
    public function show(string $id)
    {
        $detail = PenjualanDetailModel::with(['penjualan', 'barang'])->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Penjualan'
        ];

        $activeMenu = 'penjualandetail'; // set menu yang sedang aktif

        return view('penjualandetail.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit detail penjualan
    public function edit(string $id)
    {
        $detail = PenjualanDetailModel::find($id);
        $penjualans = PenjualanModel::all();
        $barangs = BarangModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Detail Penjualan'
        ];

        $activeMenu = 'penjualandetail'; // set menu yang sedang aktif

        return view('penjualandetail.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'penjualans' => $penjualans,
            'barangs' => $barangs,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data detail penjualan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        PenjualanDetailModel::find($id)->update($request->all());

        return redirect("/penjualandetail")->with('success', 'Data detail penjualan berhasil diubah');
    }

    // Menghapus data detail penjualan
    public function destroy(string $id)
    {
        $check = PenjualanDetailModel::find($id);
        if (!$check) {
            return redirect('/penjualandetail')->with('error', 'Data detail penjualan tidak ditemukan');
        }

        try {
            PenjualanDetailModel::destroy($id); // Hapus data detail penjualan
            return redirect('/penjualandetail')->with('success', 'Data detail penjualan berhasil dihapus');
        } catch (QueryException $e) {
            return redirect('/penjualandetail')->with('error', 'Data detail penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

        // Menampilkan halaman tambah detail penjualan secara AJAX
    public function create_ajax()
    {
        $barangs = BarangModel::all(); // Ambil semua data barang untuk dropdown
        $penjualans = PenjualanModel::all(); // Ambil semua penjualan untuk dropdown
        return view('penjualandetail.create_ajax', compact('barangs', 'penjualans'));
    }

    // Menyimpan data detail penjualan secara AJAX
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'jumlah' => 'required|integer|min:1',
                'harga' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            PenjualanDetailModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data detail penjualan berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    // Menampilkan halaman edit detail penjualan secara AJAX
    public function edit_ajax(string $id)
    {
        $barangs = BarangModel::all(); // Ambil semua data barang
        $penjualans = PenjualanModel::all(); // Ambil semua penjualan
        $detail = PenjualanDetailModel::find($id);
        return view('penjualandetail.edit_ajax', [
            'detail' => $detail,
            'barangs' => $barangs,
            'penjualans' => $penjualans
        ]);
    }

    // Update data detail penjualan secara AJAX
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'penjualan_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'jumlah' => 'required|integer|min:1',
                'harga' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $detail = PenjualanDetailModel::find($id);
            if ($detail) {
                $detail->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data detail penjualan berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data detail penjualan tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // Menampilkan konfirmasi penghapusan detail penjualan secara AJAX
    public function confirm_ajax(string $id)
    {
        $detail = PenjualanDetailModel::find($id);
        return view('penjualandetail.confirm_ajax', ['detail' => $detail]);
    }

    // Menghapus data detail penjualan secara AJAX
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $detail = PenjualanDetailModel::find($id);
            if ($detail) {
                $detail->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data detail penjualan berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data detail penjualan tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
    {
        return view('penjualandetail.import');
    }

        // Function Import
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_penjualandetail' => ['required', 'mimes:xlsx', 'max:1024'] // validasi file harus xlsx, max 1MB
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_penjualandetail');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // Lewati baris pertama yang merupakan header
                        $insert[] = [
                            'penjualan_id' => $value['A'],
                            'barang_id' => $value['B'],
                            'jumlah' => $value['C'],
                            'harga' => $value['D'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    PenjualanDetailModel::insertOrIgnore($insert); // Insert data ke database
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    // Function Export Excel
    public function export_excel()
    {
        $details = PenjualanDetailModel::with(['penjualan', 'barang'])
            ->select('penjualan_id', 'barang_id', 'jumlah', 'harga')
            ->orderBy('penjualan_id')
            ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Penjualan ID');
        $sheet->setCellValue('C1', 'Barang ID');
        $sheet->setCellValue('D1', 'Jumlah');
        $sheet->setCellValue('E1', 'Harga');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($details as $detail) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $detail->penjualan_id);
            $sheet->setCellValue('C' . $baris, $detail->barang_id);
            $sheet->setCellValue('D' . $baris, $detail->jumlah);
            $sheet->setCellValue('E' . $baris, $detail->harga);
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Detail Penjualan');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Detail Penjualan ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    // Function Export PDF
    public function export_pdf()
    {
        $details = PenjualanDetailModel::with(['penjualan', 'barang'])
            ->orderBy('penjualan_id')
            ->get();

        $pdf = Pdf::loadView('penjualandetail.export_pdf', ['details' => $details]);
        $pdf->setPaper('a4', 'portrait'); // Set ukuran kertas A4 dan orientasi portrait
        return $pdf->stream('Detail Penjualan ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
