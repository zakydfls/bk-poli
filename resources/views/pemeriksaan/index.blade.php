@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <div class="card-header d-flex gap-3 align-items-center">
                <h4 class="card-title">Form Pemeriksaan</h4>
            </div>
            <!--end card-header-->
            <div class="card-body table-responsive">
                <form method="POST" action="{{ route('pemeriksaan.store') }}">
                    @csrf
                    <input type="hidden" name="id_daftar_poli" value="{{ $data->id }}">
                    <input type="hidden" name="id_obat_selected" value="{{ json_encode($ids_obat) }}">
                    <input type="hidden" name="biaya_pemeriksaan">
                    <div class="mb-3 row">
                        <label for="tgl_periksa" class="form-label col-sm-2">Tanggal Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="tgl_periksa" name="tgl_periksa" value={{ $data
                                ?? '' && $data ?? '' ->periksa ? $data ?? ''->periksa->tgl_periksa : '' }} required />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="catatan" class="form-label col-sm-2">Catatan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="catatan" name="catatan"
                                required>{{ $data->periksa->catatan ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_obat" class="form-label col-sm-2">Obat</label>
                        <div class="col-sm-10 d-flex gap-3">
                            <select class="form-control select2" id="id_obat" name="id_obat" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                            <button type="button" id="buttonAddObat" class="btn btn-outline-primary"
                                style="width: 150px"><i class="mdi mdi-plus me-2"></i>Tambah</button>
                        </div>
                        <div class="col-sm-2"></div>
                        <div id="info-obat" class="col-sm-10 mt-3">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="biaya" class="form-label col-sm-2">Biaya Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="biaya" name="biaya" value="Rp. 150.000"
                                disabled />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="biaya_pemeriksaan_mock" class="form-label col-sm-2">Total Biaya</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="biaya_pemeriksaan_mock"
                                name="biaya_pemeriksaan_mock"
                                value="{{ $data && $data->periksa ? number_format($data->periksa->biaya_periksa ?? 0, 2) : 'Rp. 150.000' }}"
                                disabled />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <br>
    </div>
</div>
@endsection
@section('js')
<script>
    var type_id = "";
        var data_obat = [];
        const HOST_URL = '{{ url("/") }}';

        function formatRupiah(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return 'Rp ' + rupiah;
        }

        const getObat = () => {
            $.ajax({
                url: `${HOST_URL}/obat/data`,
                method: 'GET',
                success: function(response) {
                    data_obat = response.data;
                    let options = response.data.map(oabt => `<option value="${oabt.id}">${oabt.nama_obat}</option>`);
                    $('#id_obat').html(options);
                    renderInfoObat();
                }
            });
        }

        const renderInfoObat = () => {
            let id_obat_selected = $('input[name="id_obat_selected"]').val();

            // Parse the existing value to an array
            id_obat_selected = id_obat_selected ? JSON.parse(id_obat_selected) : [];

            const renderHtml = id_obat_selected.map(id => {
    const obat = data_obat.find(o => o.id == id);
    if (!obat) return '';
    return `<div class="d-flex align-items-center justify-content-between mb-2">
        <span>${obat.nama_obat} - ${formatRupiah(obat.harga)}</span>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeObat(${id})">
            <i class="fas fa-trash"></i>
        </button>
    </div>`;
});

            const biaya_periksa = 150000;
            const total = id_obat_selected.reduce((acc, curr) => {
                const obat = data_obat.find(o => o.id == curr);
                if (!obat) return acc;
                return acc + obat.harga;
            }, 0);

            $('input[name="biaya_pemeriksaan_mock"]').val(formatRupiah(total + biaya_periksa));
            $('input[name="biaya_pemeriksaan"]').val(total + biaya_periksa);
            $('#info-obat').html(renderHtml);
        }
        const removeObat = (id) => {
    let id_obat_selected = $('input[name="id_obat_selected"]').val();
    id_obat_selected = JSON.parse(id_obat_selected);
    
    // Remove the obat from array
    id_obat_selected = id_obat_selected.filter(item => item != id);
    
    // Update hidden input
    $('input[name="id_obat_selected"]').val(JSON.stringify(id_obat_selected));
    
    // Re-render obat list and update total
    renderInfoObat();
}
        const addObat = () => {
            const id_obat = $('#id_obat').val();
            let id_obat_selected = $('input[name="id_obat_selected"]').val();

            // Parse the existing value to an array
            id_obat_selected = id_obat_selected ? JSON.parse(id_obat_selected) : [];

            // Check if id_obat already exists in the array
            if (!id_obat_selected.includes(id_obat)) {
                // Push the new id_obat to the array
                id_obat_selected.push(id_obat);

                // Update the input value with the new array
                $('input[name="id_obat_selected"]').val(JSON.stringify(id_obat_selected));
            } else {
                alert('Obat sudah ditambahkan.');
            }

            renderInfoObat();

            console.log('id_obat', id_obat);
            console.log('id_obat_selected', id_obat_selected);
        }

        jQuery(document).ready(function() {

            getObat();
            renderInfoObat();

            $('#buttonAddObat').on('click', function() {
                addObat();
            });
        });
</script>

@endsection