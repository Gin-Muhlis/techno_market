<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;

class ExportController extends Controller
{
    public function exportPenjualan(Request $request) {
        $this->authorize('view-any', Penjualan::class);

        $tanggal_awal = $request->input('tanggal_awal') ?? null;
        $tanggal_akhir = $request->input('tanggal_akhir') ?? null;

    
       if (!is_null($tanggal_awal) && !is_null($tanggal_akhir)) {
        return Excel::download(new LaporanPenjualanExport($tanggal_awal, $tanggal_akhir), 'laporan-penjualan.xlsx');
       }
       return Excel::download(new LaporanPenjualanExport, 'laporan-penjualan.xlsx');
    }
}
