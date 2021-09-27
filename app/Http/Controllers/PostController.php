<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'posting' => 'required'

    	],
    	[
    		'posting.required' => 'Kolom posting harus di isi !',
    	]
    	);

    	if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $sarana = Sarana::create([
                'kode_barang' => $request->input('kode_barang'),
                'ruang' => $request->input('ruang'),
                'no_register' => $request->input('no_register'),
                'nama_barang' => $request->input('nama_barang'),
                'merk' => $request->input('merk'),
                'type' => $request->input('type'),
                'ukuran' => $request->input('ukuran'),
                'bahan' => $request->input('bahan'),
                'warna' => $request->input('warna'),
                'asal_usul' => $request->input('asal_usul'),
                'kondisi' => $request->input('kondisi'),
                'tanggal_perolehan' => $request->input('tanggal_perolehan'),
                'harga_perolehan_awal' => $request->input('harga_perolehan_awal'),
                'penambahan_pengurangan_nilai' => $request->input('penambahan_pengurangan_nilai'),
                'nilai_perolehan' => $request->input('nilai_perolehan'),
                'keterangan' => $request->input('keterangan'),
                'status' => $request->input('status')
            ]);

            if ($sarana) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sarana berhasil di simpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sarana gagal di simpan!',
                ], 400);
            }
        }

    }
}
