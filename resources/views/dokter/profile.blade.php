@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-header d-flex gap-3 align-items-center">
                <h4 class="card-title">Edit Profil Dokter</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dokter.update-profile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $dokter->id }}">

                    <div class="mb-10">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama"
                            value="{{ $dokter->nama }}" required>
                    </div>

                    {{-- <div class="mb-10">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat"
                            value="{{ $dokter->alamat }}" required>
                    </div> --}}

                    <div class="mb-10">
                        <label class="form-label">No HP</label>
                        <input type="number" class="form-control" name="no_hp" placeholder="No HP"
                            value="{{ $dokter->no_hp }}" required>
                    </div>

                    {{-- <div class="mb-10">
                        <label class="form-label">Poli</label>
                        <select class="form-control" name="id_poli" required>
                            <option value="" disabled>Pilih Poli</option>
                            @foreach ($polis as $poli)
                            <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama_poli }}
                            </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection