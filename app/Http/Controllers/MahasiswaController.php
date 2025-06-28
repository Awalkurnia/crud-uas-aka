<?php

namespace App\Http\Controllers;

use App\Http\Resources\MahasiswaResource;
use App\Models\mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mahasiswas = Mahasiswa::all();
        return MahasiswaResource::collection($mahasiswas);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nim' => 'required|unique:mahasiswas,nim',
        'nama' => 'required',
        'jk' => 'required|in:L,P',
        'tgl_lahir' => 'required|date',
        'jurusan' => 'required',
        'alamat' => 'required',
    ]);

    $mahasiswa = Mahasiswa::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Data mahasiswa berhasil disimpan',
        'data' => $mahasiswa
    ], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $mahasiswa =Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
    'nim' => 'required|string|max:12|unique:mahasiswas,nim,' . $id . ',nim',
    'nama' => 'required|string|max:255',
    'jk' => 'required|string|max:1',
    'tgl_lahir' => 'required|date',
    'jurusan' => 'required|string|max:100',
    'alamat' => 'required|string|max:255',
]);


    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->update($request->all());

    return (new MahasiswaResource($mahasiswa))
        ->additional([
            'success' => true,
            'message' => 'Mahasiswa updated successfully'
        ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mahasiswa = Mahasiswa::findOrfail($id);
        $mahasiswa->delete();

        return (new MahasiswaResource($mahasiswa))
        ->additional([
            'success' => true,
            'message' => 'Mahasiswa deleted successfully'
        ]);
    }
}