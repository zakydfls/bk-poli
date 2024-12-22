@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Registrasi Jadwal</h3>
                <form action="{{ route('daftar-poli.create') }}" method="POST">
                    @csrf
                    <!-- Pilihan Hari -->
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <div>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <label class="form-check form-check-inline">
                                <input type="radio" name="hari" value="{{ $hari }}" class="form-check-input" required>
                                <span class="form-check-label">{{ $hari }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pilih Poli -->
                    <div class="form-group mt-4">
                        <label for="poli">Poli</label>
                        <select name="poli" id="poli" class="form-control" required>
                            <option value="" disabled selected>Pilih Poli</option>
                            @foreach($polis as $poli)
                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jadwal Tersedia -->
                    <div class="form-group mt-4">
                        <label for="jadwal_tersedia">Jadwal Tersedia</label>
                        <div id="jadwal-container" class="d-flex flex-wrap gap-3">
                            <!-- Jadwal akan dimuat di sini -->
                            <div class="alert alert-info w-100 text-center">
                                Silakan pilih Hari dan Poli untuk melihat jadwal.
                            </div>
                        </div>
                        <!-- Input hidden untuk menyimpan ID jadwal -->
                        <input type="hidden" name="id_jadwal" id="id_jadwal" value="">
                    </div>

                    <!-- Keluhan -->
                    <div class="form-group mt-4">
                        <label for="keluhan">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" class="form-control" rows="3"
                            placeholder="Masukkan keluhan" required></textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        // Fungsi untuk melakukan fetching jadwal
        function fetchJadwal() {
            let hari = $('input[name="hari"]:checked').val();
            let poli = $('#poli').val();

            if (hari && poli) {
                $.ajax({
                    url: '{{ route("daftar-poli.jadwal") }}',
                    method: 'GET',
                    data: {
                        poli: poli,
                        hari: hari,
                        id_dokter: poli
                    },
                    success: function(response) {
    let jadwalContainer = $('#jadwal-container');
    jadwalContainer.empty(); // Kosongkan container

    if (response.data.length > 0) {
        response.data.forEach(jadwal => {
            let html = `
                <div class="jadwal-option" 
                     data-id="${jadwal.id}">
                    <strong>${jadwal.dokter.nama}</strong> <br>
                    ${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}
                </div>
            `;
            jadwalContainer.append(html);
        });
    } else {
        jadwalContainer.html(`
            <div class="alert alert-danger w-100 text-center">
                Jadwal tidak tersedia untuk pilihan ini.
            </div>
        `);
    }
},

                    error: function() {
                        $('#jadwal-container').html(`
                            <div class="alert alert-danger">
                                Terjadi kesalahan saat mengambil data.
                            </div>
                        `);
                    }
                });
            }
        }

        // Event listener untuk perubahan hari
        $('input[name="hari"]').on('change', fetchJadwal);

        // Event listener untuk perubahan poli
        $('#poli').on('change', fetchJadwal);

        // Event listener untuk memilih jadwal
        $(document).on('click', '.jadwal-option', function() {
            // Ambil ID jadwal yang diklik
            let idJadwal = $(this).data('id');
            // Set ID jadwal ke input hidden
            $('#id_jadwal').val(idJadwal);

            // Reset warna semua jadwal
            $('.jadwal-option').removeClass('alert-success').addClass('alert-warning');
            // Beri warna pada jadwal yang dipilih
            $(this).removeClass('alert-warning').addClass('alert-success');
        });
    });
</script>
@endsection
<style>
    /* Card styling */
    .card {}

    /* Title styling */
    .card-title {
        font-size: 1.5rem;
        font-weight: medium;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Form group spacing */
    .form-group {
        margin-bottom: 20px;
        /* Jarak antar elemen form */
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 10px;
        /* Jarak antara label dan input */
    }

    .form-control,
    .form-check-input {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea.form-control {
        resize: none;
        /* Disable textarea resize */
    }

    /* Radio button styling */
    .form-check {
        margin-right: 15px;
        /* Memberikan jarak antara radio button */
    }

    .form-check-label {
        margin-left: 5px;
    }

    /* Jadwal container styling */
    #jadwal-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        /* Jarak antar kotak */
        margin-top: 15px;
        /* Jarak ke atas */
        padding: 10px;
        /* Padding internal */
    }

    .jadwal-option {
        flex: 0 0 calc(20% - 15px);
        /* Maksimal 5 kotak per baris */
        max-width: calc(20% - 15px);
        text-align: center;
        cursor: pointer;
        padding: 15px;
        border: 1px solid #ffc107;
        background-color: #fff3cd;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Shadow lembut */
    }

    .jadwal-option:hover {
        background-color: #ffe8a1;
        transform: scale(1.05);
    }

    .jadwal-option.alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        font-weight: medium;
    }

    /* Button styling */
    button.btn-primary {
        margin-top: 10px;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: medium;
        border-radius: 5px;
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    button.btn-primary:hover {
        background-color: #0056b3;
        color: #ffffff;
    }

    /* Alert styling */
    .alert {
        margin: 0 auto;
        padding: 10px;
        text-align: center;
        font-weight: 600;
    }

    /* Small screen optimization */
    @media (max-width: 768px) {
        .jadwal-option {
            flex: 0 0 calc(50% - 10px);
            /* 2 kotak per baris di layar kecil */
            max-width: calc(50% - 10px);
        }
    }
</style>