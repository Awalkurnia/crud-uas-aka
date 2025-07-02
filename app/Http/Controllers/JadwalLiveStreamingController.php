<?php

namespace App\Http\Controllers;

use App\Models\JadwalLiveStreaming;
use Illuminate\Http\Request;

class JadwalLiveStreamingController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => JadwalLiveStreaming::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_acara' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'platform' => 'required',
        ]);
        $jadwal = JadwalLiveStreaming::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Data jadwal live streaming berhasil disimpan',
            'data' => $jadwal
        ], 201);
    }

    public function show($id)
    {
        $jadwal = JadwalLiveStreaming::findOrFail($id);
        return response()->json($jadwal);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_acara' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'platform' => 'required',
        ]);
        $jadwal = JadwalLiveStreaming::findOrFail($id);
        $jadwal->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'Data jadwal live streaming berhasil diupdate',
            'data' => $jadwal
        ]);
    }

    public function destroy($id)
    {
        $jadwal = JadwalLiveStreaming::findOrFail($id);
        $jadwal->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data jadwal live streaming berhasil dihapus'
        ]);
    }
} 