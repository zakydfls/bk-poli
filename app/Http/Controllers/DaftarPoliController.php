<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['judul'] = "Daftar Poli";
        $data['sub_judul'] = "Daftar Poli";
        // $data['jadwal_periksa'] = JadwalPeriksa::all();
        $data['polis'] = Poli::all();
        return view('registrasi.index', $data);
    }

    public function dataJadwalPeriksa(Request $request)
    {
        $query = JadwalPeriksa::with('dokter')->orderBy('created_at', 'desc');

        if ($request->has('hari')) {
            $query->where('hari', $request->input('hari'));
        }

        // if ($request->has('id_dokter')) {
        //     $query->where('id_dokter', $request->input('id_dokter'));
        // }
        $jadwalPeriksas = $query->get();
        // dd($jadwalPeriksas->all);
        return response()->json([
            'data' => $jadwalPeriksas
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'id_jadwal' => 'required',
            'keluhan' => 'required',
        ]);

        $no_antrian = DaftarPoli::count() + 1;
        $id_pasien = Auth::user()->id_pasien;

        DaftarPoli::create([
            'id_pasien' => $id_pasien,
            'id_jadwal' => $payload['id_jadwal'],
            'keluhan' => $payload['keluhan'],
            'no_antrian' => $no_antrian,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarPoli  $daftarPoli
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarPoli  $daftarPoli
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarPoli  $daftarPoli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarPoli  $daftarPoli
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarPoli $daftarPoli)
    {
        //
    }
}
