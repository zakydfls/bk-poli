@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card">
            <!--begin::Navbar-->
            <!--begin::Wrapper-->
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    {{-- <div class="d-flex flex-stack mt-20"> --}}
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
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
                        <!--end::Search-->
                        {{--
                    </div> --}}
                </div>
            </div>
            <!--end::Wrapper-->
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <table id="data_table" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>Tanggal Daftar</th>
                            <th>Hari Pemeriksaan</th>
                            <th>Pasien</th>
                            <th>Antrian</th>
                            <th>Keluhan</th>
                            <th>Biaya Pemeriksaan</th>
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
</div>
<!--end::Datatable-->
@endsection
@section('js')
<script>
    dt = $("#data_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('daftar-poli.data') }}",
        "columns": [
            {
            data: 'created_at',
                    name: 'nama_poli',
                        render: function(data, type, row) {
                            return new Date(data).toLocaleString();
                        }
                    },
                    { data: 'jadwal_periksa.hari', name: 'hari' },
                    { data: 'pasien.nama', name: 'nama' },
                    { data: 'no_antrian', name: 'no_antrian' },
                    { data: 'keluhan', name: 'keluhan' },
                    {
                        data: 'periksa',
                        name: 'biaya_periksa',
                        render: function(data, type, row) {
                            let nominal = undefined;
                            if (row?.periksa?.biaya_periksa) {
                                nominal = row.periksa.biaya_periksa;
                            }

                            console.log('nominal', nominal);
                            return (nominal ? formatRupiah(nominal) : '-');
                        }
                    },
                    {
                        data: 'id',
                        name: 'status',
                        render: function(data, type, row) {
                            let status = '-';
                            let badge = '';
                            if (row.periksa) {
                                badge = 'badge-soft-success';
                                status = 'Selesai';
                            } else {
                                badge = 'badge-soft-info';
                                status = 'Menunggu Pemeriksaan';
                            }
                            return `<span class="badge ${badge}">${status}</span>`;
                        }
                    },
            {
                data: 'action',     
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
        columnDefs: [
            {
                        targets: 1,
                        render: function(data, type, row) {
                            return `${row.jadwal_periksa.hari}<br />${row.jadwal_periksa.jam_mulai}-${row.jadwal_periksa.jam_selesai}`;
                        }
                    },
        ],
    });

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options
        filterPayment = document.querySelectorAll('[data-kt-docs-table-filter="payment_type"] [name="payment_type"]');
        const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            // Get filter values
            let paymentValue = '';

            // Get payment value
            filterPayment.forEach(r => {
                if (r.checked) {
                    paymentValue = r.value;
                }

                // Reset payment value if "All" is selected
                if (paymentValue === 'all') {
                    paymentValue = '';
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            dt.search(paymentValue).draw();
        });
    }   

    handleSearchDatatable();

    
</script>
@endsection
<style>
    .badge.badge-soft-success {
        background-color: rgba(3, 216, 127, 0.15) !important;
        color: #03d87f !important;
        box-shadow: 0px 0px 13px 0px rgba(3, 216, 127, 0.05);
    }

    .badge.badge-soft-warning {
        background-color: rgba(255, 184, 34, 0.15) !important;
        color: #ffb822 !important;
        box-shadow: 0px 0px 13px 0px rgba(255, 184, 34, 0.05);
    }

    .badge.badge-soft-info {
        background-color: rgba(18, 164, 237, 0.15) !important;
        color: #12a4ed !important;
        box-shadow: 0px 0px 13px 0px rgba(18, 164, 237, 0.05);
    }
</style>