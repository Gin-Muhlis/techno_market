<?php

namespace App\Exports;

use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class LaporanPenjualanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($inputTanggalAwal = null, $inputTanggalAkhir = null) {
        $this->tanggal_awal = $inputTanggalAwal;
        $this->tanggal_akhir = $inputTanggalAkhir;
    }
    public function view(): View
    {
        $tanggal_awal = $this->tanggal_awal;
        $tanggal_akhir = $this->tanggal_akhir;

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

        return view('app.export.penjualan', compact('laporan', 'total_omset'));
    }
}
