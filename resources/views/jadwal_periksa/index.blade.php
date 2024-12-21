@extends('layouts.template')

@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <!--begin::Navbar-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="grey"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="grey"></path>
                        </svg>
                        <input type="text" data-kt-docs-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15" placeholder="Pencarian"
                            name="search" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                        <!--begin::Add Jadwal-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Jadwal Periksa
                        </button>
                        <!--end::Add Jadwal-->
                    </div>
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <table id="data_table" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Dokter</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th width="16%">#</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold fs-6">
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
    <!--end::Datatable-->

    <!-- Modal Tambah Jadwal-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-7 d-flex justify-content-between">
                    <h2 class="modal-title">Tambah Jadwal Periksa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jadwal-periksa.create') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-10">
                            <label class="form-label">Hari</label>
                            <input type="hidden" value="{{ url('/') }}" id="url">
                            <input type="hidden" value="{{ csrf_token() }}" id="token">
                            <select class="form-control" name="hari" required>
                                <option value="" disabled selected>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" name="jam_mulai" placeholder="HH:MM" required>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" name="jam_selesai" placeholder="HH:MM" required>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="0">Non-Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Jadwal-->
    <!-- Modal Ubah Jadwal Periksa -->
    <div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Jadwal Periksa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jadwal-periksa.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-10">
                            <label class="form-label">Hari</label>
                            <input type="hidden" id="id_u" name="id">
                            <select class="form-control" name="hari" id="hari_u" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Jam Mulai</label>
                            <input type="text" class="form-control" name="jam_mulai" id="jam_mulai_u"
                                placeholder="HH:MM" required>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Jam Selesai</label>
                            <input type="text" class="form-control" name="jam_selesai" id="jam_selesai_u"
                                placeholder="HH:MM" required>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" id="status_u" required>
                                <option value="0">Non-Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ubah Jadwal Periksa -->

</div>
@endsection

@section('js')
<script>
    // Inisialisasi DataTable
    dt = $("#data_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('jadwal-periksa.data') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'dokter.nama', name: 'dokter.nama'},
            {data: 'hari', name: 'hari'},
            {data: 'jam_mulai', name: 'jam_mulai'},
            {data: 'jam_selesai', name: 'jam_selesai'},
            {data: 'status', name: 'status',            render: function(data, type, row) {
                if(data == 1) {
                    return `<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </span>`;
                } else {
                    return `<span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                    </span>`;
                }
            }
        },
            {data: 'action', name: 'action'}
        ]
    });

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    handleSearchDatatable();

    $(document).on('click', '.hapus', function () {
        let id = $(this).data('id')
        var token = $('#token').val();
        console.clear();
        Swal.fire({
            title: 'Apa Anda yakin untuk Hapus?',
            text: "Data yang terhapus tidak bisa dikembalikan. :(",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batalkan!',
            reverseButtons: true,
            padding: '2em'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST", 
                    headers:{'X-CSRF-TOKEN': token},
                    url: "{{route('jadwal-periksa.delete')}}", 
                    dataType : "JSON",              
                    data:{id:id},
                        success: function(data){
                        Swal.fire({
                            title: 'Terhapus!',
                            text: "Data berhasil dihapus!",
                            icon: 'success'
                        })
                        $('#data_table').DataTable().ajax.reload();
                    },                    
                    error: function(data){
                        Swal.fire({
                            title: 'Error!',
                            text: "Ups! Sepertinya ada yang salah :(",
                            icon: 'error'
                        })
                    }
                })
            } 
        })
    })

    $(document).on('click', '.ubah', function () {  
        let id = $(this).data('id');
        let hari = $(this).data('hari');
        let jam_mulai = $(this).data('jam_mulai');
        let jam_selesai = $(this).data('jam_selesai');
        let status = $(this).data('status');

        $('#id_u').val(id);
        $('#hari_u').val(hari);
        $('#jam_mulai_u').val(jam_mulai);
        $('#jam_selesai_u').val(jam_selesai);
        $('#status_u').val(status);
    });
</script>
@endsection