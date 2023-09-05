<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Kontak;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersEndController extends Controller
{
    public function index() {
        $produkMakanan = Barang::where('produk_id', '1')->get();
        $produkMinuman = Barang::where('produk_id', '2')->get();

        return view('welcome', compact('produkMakanan', 'produkMinuman'));
    }

    public function order(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'nama_pelanggan' => ['required', 'max:255', 'string'],
                'alamat' => ['required', 'max:255', 'string'],
                'no_telp' => ['required', 'max:255', 'string'],
                'quantity' => ['required', 'numeric'],
                'produk_id' => ['required', 'exists:produks,id'],
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }
    
            $last_pelanggan = Pelanggan::latest()->first();
            $validated = $validator->validated();
            $kode_pelanggan = is_null($last_pelanggan) ? 'PG001' : sprintf('PG%03d', intval(substr($last_pelanggan->kode_pelanggan, 1)) + 1);
    
            $barang = Barang::find($validated['produk_id']);
            $last_transaksi = Penjualan::latest()->first();
            
            $no_faktur = is_null($last_transaksi) ? 'TP0000001' : sprintf('TP%07d', intval(substr($last_transaksi->no_faktur, 1)) + 1);
            $tanggal_transaksi = Carbon::now()->format('Y-m-d');
    
            DB::beginTransaction();
    
            $pelanggan = Pelanggan::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'alamat' => $validated['alamat'],
                'no_telp' => $validated['no_telp'],
                'kode_pelanggan' => $kode_pelanggan
            ]);
    
    
            $penjualan = Penjualan::create([
                'no_faktur' => $no_faktur,
                'tanggal_faktur' => $tanggal_transaksi,
                'total_bayar' => $validated['quantity'] * $barang->harga_jual,
                'pelanggan_id' => $pelanggan->id,
                'user_id' => 1
            ]);
    
            DetailPenjualan::create([
                'harga_satuan' => $barang->harga_jual,
                'quantity' => $validated['quantity'],
                'sub_total' => $validated['quantity'] * $barang->harga_jual,
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang->id
            ]);
    
            DB::commit();
            
            return redirect()->back()->with('success', 'Pesanan berhasil dibuat. Silahkan menunggu 5-10 menit.');
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withErrors(['success', 'Terjadi Kesalahan! Silahkan mencoba lagi. Jika masih berlanjut dilahkan hubungi pihak yang berkaitan']);
        }
    }

    public function contact(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'nama' => ['required', 'max:255', 'string'],
                    'pesan' => ['required',],
                ],
                [
                    'nama.required' => 'Nama tidak boleh kosong',
                    'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                    'nama.string' => 'Nama anda mengandung karakter yang tidak valid',
                    'pesan.required' => 'Pesan harus diisi',
                ]
            );
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }
    
            $validated = $validator->validated();
            $date_now = Carbon::now()->format('Y-m-d');
    
            $validated['tanggal'] = $date_now;
    
            DB::beginTransaction();
            Kontak::create($validated);
            DB::commit();
        
            return redirect()->back()->with('success', 'Pesan berhasil terkirim');
        } catch(Exception $error) {
            DB::rollback();
        
            return redirect()->back()->withErrors(['success', 'Terjadi Kesalahan! Silahkan mencoba lagi. Jika masih berlanjut dilahkan hubungi pihak yang berkaitan']);
        }

    }
}
