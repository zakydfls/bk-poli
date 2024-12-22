<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

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
    public function history()
    {
        $data['judul'] = "Riwayat Pemeriksaan";
        $data['sub_judul'] = "Riwayat Pemeriksaan";
        return view('history.index', $data);
    }

    public function dataJadwalPeriksa(Request $request)
    {
        $query = JadwalPeriksa::with('dokter')
            ->where('status', 1) // Only get active schedules
            ->orderBy('created_at', 'desc');

        if ($request->has('hari')) {
            $query->where('hari', $request->input('hari'));
        }

        if ($request->has('poli')) {
            $query->whereHas('dokter', function ($q) use ($request) {
                $q->where('id_poli', $request->poli);
            });
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

    public function data(Request $request)
    {
        if ($request->ajax()) {
            // Ambil ID pasien dari pengguna yang sedang login
            $id_pasien = Auth::user()->id_pasien;

            // Query untuk mengambil data DaftarPoli dengan relasi yang diperlukan
            $daftarPolis = DaftarPoli::with('jadwalPeriksa.dokter.poli', 'periksa', 'pasien');

            // Filter based on user role
            if (Auth::user()->role === 'dokter') {
                // Get doctor ID from the authenticated user
                $dokter_id = Auth::user()->id_dokter;

                // For dokter, show only their examinations using proper relationship
                $daftarPolis->whereHas('jadwalPeriksa', function ($query) use ($dokter_id) {
                    $query->where('id_dokter', $dokter_id);
                });
            } else if (Auth::user()->role === 'pasien') {
                $daftarPolis->where('id_pasien', Auth::user()->id_pasien);
            }
            $data = $daftarPolis->orderBy('created_at', 'desc')->get();
            Log::info('Doctor ID: ' . $dokter_id = Auth::user()->id_dokter);
            Log::info('Query: ' . $daftarPolis->toSql());
            Log::info('Data count: ' . $data->count());
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_poli', function ($row) {
                    return $row->jadwalPeriksa->dokter->poli->nama_poli ?? 'Tidak Ada';
                })
                ->addColumn('action', function ($row) {
                    if (Auth::user()->role === 'dokter' || Auth::user()->role === 'admin') {
                        $actionBtn = '
                    <a href="' . route('pemeriksaan.action', $row->id) . '" class="btn btn-icon btn-success ubah">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="white"/>
                        <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="white"/>
                        <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="white"/>
                    </svg>
                    </a>
                <a href="' . route('daftar-poli.detail', $row->id) . '" class="btn btn-icon btn-info detail">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="white"/>
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="white"/>
                    <rect x="8" y="12" width="8" height="2" rx="1" fill="white"/>
                    <rect x="8" y="16" width="8" height="2" rx="1" fill="white"/>
                </svg></a>
                    ';
                    }
                    if (Auth::user()->role === 'pasien') {
                        $actionBtn = '
                <a href="' . route('daftar-poli.detail', $row->id) . '" class="btn btn-icon btn-info detail">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="white"/>
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="white"/>
                    <rect x="8" y="12" width="8" height="2" rx="1" fill="white"/>
                    <rect x="8" y="16" width="8" height="2" rx="1" fill="white"/>
                </svg></a>
                    ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action']) // Menandai kolom action agar HTML bisa dirender
                ->make(true);
        }
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
