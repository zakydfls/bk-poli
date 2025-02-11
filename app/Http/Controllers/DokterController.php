<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokterRequest;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['judul'] = "Dokter";
        $data['sub_judul'] = "Dokter";
        $data['polis'] = Poli::all();
        return view('dokter.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(DokterRequest $request)
    {
        try {
            $data = $request->validated();
            $dokter = Dokter::create($data);
            // dd($dokter);
            User::create([
                'name' => $dokter->nama,
                'email' => $dokter->nama . '@gmail.com',
                'password' => bcrypt($dokter->alamat),
                'role' => 'dokter',
                'username' => $dokter->nama,
                'id_dokter' => $dokter->id
            ]);

            return redirect()->route('dokter')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dokter')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokter::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_poli', function ($row) {
                    return $row->poli->nama_poli ?? 'Tidak Ada';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <button class="btn btn-icon btn-success ubah" data-bs-toggle="modal" data-bs-target="#modalUbah" 
                    data-id="' . $row->id . '" 
                    data-nama="' . $row->nama . '"
                    data-alamat="' . $row->alamat . '"
                    data-no_hp="' . $row->no_hp . '"
                    data-id_poli="' . $row->id_poli . '"
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     */
    public function edit(Dokter $dokter)
    {
        $id_dokter = Auth::user()->id_dokter;
        $dokter = Dokter::where('id', $id_dokter)->first();

        $polis = Poli::all();

        return view('dokter.profile', [
            'dokter' => $dokter,
            'polis' => $polis,
            'judul' => 'Profil Dokter',
            'sub_judul' => 'Edit Profil'
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $id = Auth::user()->id_dokter;
            $data = $request->validate([
                'nama' => 'required',
                'no_hp' => 'required',
            ]);
            Dokter::where('id', $id)->update($data);

            return redirect()->route('dokter.profile')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('dokter.profile')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DokterRequest $request)
    {
        try {
            $id = $request->id;
            $data = $request->validated();
            Dokter::where('id', $id)->update($data);

            $user = User::where('id_dokter', $id)->first();
            if ($user) {
                $user->name = $data['nama'];
                $user->username = $data['nama'];
                $user->role = 'dokter';
                $user->email = $data['nama'] . '@gmail.com';
                $user->password = bcrypt($data['alamat']);
                $user->save();
            }

            return redirect()->route('dokter')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('dokter')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $id = $request->id;
            if (!$id) {
                return response()->json(['error' => 'ID tidak ditemukan'], 400);
            }
            Dokter::destroy($id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
