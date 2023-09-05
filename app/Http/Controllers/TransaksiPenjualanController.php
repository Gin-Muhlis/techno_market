<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiPenjualanController extends Controller
{
    public function index(Request $request) {
        $this->authorize('view-any', Penjualan::class);

        $tanggal_awal = $request->input('tanggal_awal') ?? null;
        $tanggal_akhir = $request->input('tanggal_akhir') ?? null;

        $sekarang = Carbon::now()->format('Y-m-d');

        $data_penjualan = Penjualan::with(['detailPenjualans', 'user', 'pelanggan'])->whereTanggalFaktur($sekarang)->get();

        if (!is_null($tanggal_awal) && !is_null($tanggal_akhir)) {
            $data_penjualan = Penjualan::with(['detailPenjualans', 'user', 'pelanggan'])->whereBetween('tanggal_faktur', [$tanggal_awal, $tanggal_akhir])->get();
        }
        
        return view('app.transaksi.order', compact('data_penjualan', 'sekarang', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function create() {
        $this->authorize('create', Penjualan::class);

        if (!Auth::user()->hasRole('operator')) {
            abort(404);
        }

        $barang = Barang::latest()->get();
        $pelanggan = Pelanggan::latest()->get();

        return view('app.transaksi.penjualan', compact('barang', 'pelanggan'));
    }

    public function store(Request $request) {
        try {
            $this->authorize('create', Penjualan::class);

        $validator = Validator::make($request->all(), [
            'totalTransaksi' => ['required', 'numeric'],
            'pelanggan' => ['required', 'numeric'],
            'barang' => ['required', 'array']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Terjadi Kesalahan dengan data yang dikirim',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $user = Auth::user();
        $last_transaksi = Penjualan::latest()->first();
        
        $no_faktur = is_null($last_transaksi) ? 'TP0000001' : sprintf('TP%07d', intval(substr($last_transaksi->no_faktur, 1)) + 1);
        $tanggal_transaksi = Carbon::now()->format('Y-m-d');

        DB::beginTransaction();

        $penjualan = Penjualan::create([
            'no_faktur' => $no_faktur,
            'tanggal_faktur' => $tanggal_transaksi,
            'total_bayar' => $validated['totalTransaksi'],
            'pelanggan_id' => $validated['pelanggan'],
            'user_id' => $user->id
        ]);

        foreach ($validated['barang'] as $barang) {
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang['barang']['id'],
                'quantity' => $barang['qty'],
                'harga_satuan' => $barang['barang']['harga_jual'],
                'sub_total' => $barang['subTotal']
            ]);
        }

        DB::commit();

        return response()->json([
            'message' => 'Transaksi Berhasil Ditambahkan'
        ]);
        } catch (Exception $error) {
            DB::rollback();
            return response()->json([
                'message' => $error->getMessage()
            ], 500);
        }

    }
}
