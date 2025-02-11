@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif --}}
                    <div class="card-header d-flex gap-3 align-items-center">
                        <h4 class="card-title">Detail Informasi</h4>
                        <div>
                            <span class="badge {{ $data->periksa ? 'badge-soft-success' : 'badge-soft-warning' }}">{{
                                $data->periksa ? 'Selesai' : 'Menunggu Pemeriksaan' }}</span>
                        </div>
                    </div>
                    <!--end card-header-->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-gray-600 fw-semibold fs-6">Antrian</td>
                                    <td class="text-gray-600 fw-semibold">:</td>
                                    <td class="text-gray-600 fs-6">{{ $data->no_antrian }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 fw-semibold fs-6">Keluhan</td>
                                    <td class="text-gray-600 fw-semibold">:</td>
                                    <td class="text-gray-600 fs-6">{{ $data->keluhan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 fw-semibold fs-6">Catatan</td>
                                    <td class="text-gray-600 fw-semibold">:</td>
                                    <td class="text-gray-600 fs-6">{{ $data->periksa->catatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 fw-semibold fs-6">Biaya Pemeriksaan</td>
                                    <td class="text-gray-600 fw-semibold">:</td>
                                    <td class="text-gray-600 fs-6">Rp. {{ number_format($data->periksa->biaya_periksa ??
                                        0, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 fw-semibold fs-6">Obat</td>
                                    <td class="text-gray-600 fw-semibold">:</td>
                                    <td class="text-gray-600 fs-6">
                                        @if ($data->periksa)
                                        @foreach ($data->periksa->detailPeriksas as $detail)
                                        <p class="mb-1">{{ $detail->obat->nama_obat }} - Rp. {{
                                            number_format($detail->obat->harga, 0) }}</p>
                                        @endforeach
                                        @else
                                        -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection