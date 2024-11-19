<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuahController extends Controller
{
    
    public function index()
    {
        $buah = Buah::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Ditampilkan',
            'data' => $buah,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'warna' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $buah = Buah::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Disimpan',
            'data' => $buah,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buah = Buah::find($id);
        if (is_null($buah)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Ditemukan',
            'data' => $buah,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'warna' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $buah = Buah::findOrFail($id);
        $buah->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Diubah',
            'data' => $buah,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buah = Buah::findOrFail($id);
        $buah->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil Dihapus',
        ], 204);
    }
}
