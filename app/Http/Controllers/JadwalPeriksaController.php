<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalPeriksaRequest;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['judul'] = "Jadwal Periksa";
        $data['sub_judul'] = "Jadwal Periksa";
        $data['dokter'] = Dokter::all();
        $data['jadwal'] = JadwalPeriksa::all();
        return view('jadwal_periksa.index', $data);
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
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $id_dokter = Auth::user()->id_dokter;

            $jadwalPeriksas = JadwalPeriksa::with('dokter')
                ->when($id_dokter, function ($query, $id_dokter) {
                    return $query->where('id_dokter', $id_dokter);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            return DataTables::of($jadwalPeriksas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <button class="btn btn-icon btn-success ubah" data-bs-toggle="modal" data-bs-target="#modalUbah" 
                        data-id="' . $row->id . '" 
                        data-hari="' . $row->hari . '"
                        data-jam_mulai="' . $row->jam_mulai . '"
                        data-jam_selesai="' . $row->jam_selesai . '"
                        data-status="' . $row->status . '"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="white"/>
                            <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="white"/>
                            <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="white"/>
                        </svg>
                        </button>
                        <button class="btn btn-icon btn-danger hapus" data-bs-toggle="modal" data-id="' . $row->id . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="white"/>
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="white"/>
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="white"/>
                        </svg></button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JadwalPeriksaRequest $request)
    {
        $payload = $request->validated();
        $id_dokter = Auth::user()->id_dokter;
        if ($id_dokter) {
            $payload['id_dokter'] = $id_dokter;
        }
        $jadwal = JadwalPeriksa::create($payload);

        if ($payload['status'] == 1) {
            JadwalPeriksa::where('id_dokter', $payload['id_dokter'])
                ->where('id', '!=', $jadwal->id)
                ->update([
                    'status' => false,
                ]);
        }

        return redirect()->back()->with('success', 'Jadwal Periksa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalPeriksa  $jadwalPeriksa
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalPeriksa $jadwalPeriksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalPeriksa  $jadwalPeriksa
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalPeriksa $jadwalPeriksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request)
    {
        dd($request->all());
        $jadwalPeriksa = JadwalPeriksa::find($request->id);
        $payload = [
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ];
        $id_dokter = Auth::user()->id_dokter;

        if ($id_dokter) {
            $payload['id_dokter'] = $id_dokter;
        }

        $jadwalPeriksa->update($payload);

        if ($payload['status'] == 1) {
            JadwalPeriksa::where('id_dokter', $payload['id_dokter'])
                ->where('id', '!=', $request->id)
                ->update([
                    'status' => 0,
                ]);
        }

        return redirect()->back()->with('success', 'Jadwal Periksa berhasil diubah');

        // try {
        //     $id = $request->id;
        //     $payload = $request->validated();
        //     $id_dokter = Auth::user()->id_dokter;

        //     if ($id_dokter) {
        //         $payload['id_dokter'] = $id_dokter;
        //     }
        //     dd($payload);

        //     JadwalPeriksa::find($id)->update($payload);

        //     if ($payload['status'] == 1) {
        //         JadwalPeriksa::where('id_dokter', $payload['id_dokter'])
        //             ->where('id', '!=', $request->id)
        //             ->update([
        //                 'status' => 0,
        //             ]);
        //     }

        //     return redirect()->route('jadwal-periksa')->with('success', 'Data berhasil diubah');
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        // }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalPeriksa  $jadwalPeriksa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $id = $request->id;
            if (!$id) {
                return response()->json(['error' => 'ID tidak ditemukan'], 400);
            }
            JadwalPeriksa::destroy($id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
