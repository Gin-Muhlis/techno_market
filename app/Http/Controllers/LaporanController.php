<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPenjualan(Request $request) {
        $this->authorize('view-any', Penjualan::class);

        $tanggal_awal = $request->input('tanggal_awal') ?? null;
        $tanggal_akhir = $request->input('tanggal_akhir') ?? null;

        $sekarang = Carbon::now()->format('Y-m-d');

        $data_penjualan = Penjualan::with(['detailPenjualans', 'user', 'pelanggan'])->whereTanggalFaktur($sekarang)->get();

        if (!is_null($tanggal_awal) && !is_null($tanggal_akhir)) {
            $data_penjualan = Penjualan::with(['detailPenjualans', 'user', 'pelanggan'])->whereBetween('tanggal_faktur', [$tanggal_awal, $tanggal_akhir])->get();
        }

        
        $laporan = [];
        $total_omset = 0;
        
        foreach ($data_penjualan as $data) {
            
            foreach($data->detailPenjualans as $item) {
                $laporan[] = [
                    'tanggal' => $data->tanggal_faktur,
                    'kode' => $item->barang->kode_barang,
                    'nama' => $item->barang->nama_barang,
                    'qty' => $item->quantity,
                    'omset' => $item->sub_total
                ];
                $total_omset += $item->sub_total;
            }
           
        }


        return view('app.laporan.penjualan', compact('laporan', 'total_omset', 'sekarang', 'tanggal_awal', 'tanggal_akhir'));
    }
}
