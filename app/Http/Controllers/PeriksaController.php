<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
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
    public function create($id)
    {
        $data = DaftarPoli::with('jadwalPeriksa.dokter.poli', 'periksa.detailPeriksas.obat', 'pasien')->find($id);
        $ids_obat = $data && $data->periksa && $data->periksa->detailPeriksas ? $data->periksa->detailPeriksas->pluck('id_obat')->map(function ($id) {
            return (string) $id;
        })->toArray() : [];
        $data = [
            'judul' => "Pemeriksaan",
            'sub_judul' => "Pemeriksaan",
            'data' => $data,
            'ids_obat' => $ids_obat
        ];
        // $data['polis'] = Poli::all();
        return view('pemeriksaan.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        try {
            $allRequest = $request->all();

            // Get proper ID from daftar_poli
            $id_daftar_poli = $request->input('id_daftar_poli');

            // Validate if daftar_poli exists
            $daftarPoli = DaftarPoli::find($id_daftar_poli);
            if (!$daftarPoli) {
                return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan');
            }

            $id_obat_selected = json_decode($allRequest['id_obat_selected']);
            $biaya_pemeriksaan = $allRequest['biaya_pemeriksaan'];
            $tgl_periksa = $allRequest['tgl_periksa'];
            $catatan = $allRequest['catatan'];

            $periksa = Periksa::updateOrCreate(
                ['id_daftar_poli' => $id_daftar_poli],
                [
                    'biaya_periksa' => $biaya_pemeriksaan,
                    'tgl_periksa' => $tgl_periksa,
                    'catatan' => $catatan,
                ]
            );

            // Delete existing details first
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();

            // Create new details
            foreach ($id_obat_selected as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }

            return redirect()->route('backoffice.registrasi.detail', $id_daftar_poli)
                ->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
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
