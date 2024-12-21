<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periksa  $periksa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DaftarPoli::with('jadwalPeriksa.dokter.poli', 'periksa.detailPeriksas.obat', 'pasien')->find($id);
        $ids_obat = $data && $data->periksa && $data->periksa->detailPeriksas ? $data->periksa->detailPeriksas->pluck('id_obat')->map(function ($id) {
            return (string) $id;
        })->toArray() : [];

        $data = [
            'judul' => "Detail Periksa",
            'sub_judul' => "Detail Periksa",
            'data' => $data,
            'ids_obat' => $ids_obat
        ];

        return view('registrasi.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periksa  $periksa
     * @return \Illuminate\Http\Response
     */
    public function edit(Periksa $periksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periksa  $periksa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periksa $periksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periksa  $periksa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periksa $periksa)
    {
        //
    }
}
