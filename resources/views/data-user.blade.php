@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content col-12" id="kt_content">
		<div class="card">
			<!--begin::Navbar-->
			<!--begin::Wrapper-->
			<div class="card-header border-0 pt-6">
				<div class="card-title">
					{{-- <div class="d-flex flex-stack mt-20"> --}}
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="grey"></rect>
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="grey"></path>
							</svg>
							<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Pencarian" name="search"/>
						</div>
						<!--end::Search-->						
					{{-- </div> --}}
				</div>
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
						<!--begin::Add customer-->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah User
                        </button>
						<!--end::Add customer-->
					</div>
					<!--end::Toolbar-->
				</div>
			</div>
			<!--end::Wrapper-->
			<!--begin::Datatable-->
			<div class="card-body pt-0">
				<table id="data_table" class="table align-middle table-row-dashed fs-6 gy-5">
					<thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>OPD</th>
                            <th>Role</th>
                            <th width="16%">#</th>
                        </tr>
					</thead>
					<tbody class="text-gray-600 fw-semibold fs-6">
					</tbody>
				</table>
			</div>
			<br>
			<!--end::Datatable-->
		</div>
    </div>
    <!--end::Post-->
    {{-- start-modal --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-7 d-flex justify-content-between">
                    <h2 class="modal-title">Tambah User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('user.create')}}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="mb-10">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="hidden" value="{{ url('/') }}" id="url">
                        <input type="hidden" value="{{ csrf_token() }}" id="token">
                        <input type="text" class="form-control" name="name" placeholder="Name" id="name">
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="">
                        <span id="notif"></span>
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="">
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Role</label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-dropdown-parent="#modalTambah" data-placeholder="Pilih Role" id="role" name="role">
                            <option></option>
                            @if (Auth::user()->role == 'admin')
                                <option value="user">User</option>   
                            @elseif(Auth::user()->role == 'super')
                                <option value="super admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            @endif                            
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
    
    <div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('user.create')}}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="mb-10">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="hidden" id="id_u" name="id">
                        <input type="text" class="form-control" name="name" placeholder="Name" id="name_u">
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" id="username_u">
                        <span id="notif_u"></span>
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" id="password_u">
                    </div>
                    <div class="mb-10">
                        <label class="form-label">Role</label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-dropdown-parent="#modalUbah" data-placeholder="Pilih Role" id="role_u" name="role">
                            <option value="">Pilih Role</option>
                            @if (Auth::user()->role == 'admin')
                                <option value="user">User</option>   
                            @elseif(Auth::user()->role == 'super')
                                <option value="super admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            @endif
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
</div>
@endsection
@section('js')
<script>    
    dt = $("#data_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('user.get') }}",
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'singkatan', name: 'singkatan'},
            {data: 'role', name: 'role'},

            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
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

    var changeInterval = null;
    $('#username').on("keyup", function(){  
        $('#notif').empty()
        var url = $('#url').val();
        var username = $('#username').val();
        if(username != ''){
            clearInterval(changeInterval)
            changeInterval = setInterval(function() {
                $.ajax({type: "GET",
                    url: url+"/ajax/user/cek/"+username,
                    success:function(result){
                        if(result){
                            $('#notif').empty().append('<span class="badge badge-danger" style="margin-top: 2px">Ups! Username sudah digunakan.</span>')
                        } else {
                            $('#notif').empty().append('<span class="badge badge-success" style="margin-top: 2px">Username Tersedia</span>')
                        }
                    },
                    error:function(result)
                    {
                    }
                });
                clearInterval(changeInterval)
            }, 500); 
        }   
    });

    $('#email').on("keyup", function(){  
        $('#notif2').empty()

        var url = $('#url').val();
        var email = $('#email').val();
        if(email){
            clearInterval(changeInterval)
            changeInterval = setInterval(function() {
                $.ajax({type: "GET",
                    url: url+"/ajax/user/cek/"+email,
                    success:function(result){
                        if(result){
                            $('#notif2').empty().append('<span class="badge badge-danger" style="margin-top: 2px">Ups! Email sudah digunakan.</span>')
                        } else {
                            $('#notif2').empty().append('<span class="badge badge-success" style="margin-top: 2px">Email Tersedia</span>')
                        }
                    },
                    error:function(result)
                    {
                    }
                });
                clearInterval(changeInterval)
            }, 500); 
        } 

    });

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
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST", 
                    headers:{'X-CSRF-TOKEN':token},
                    url: "{{route('user.delete')}}", 
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
        let id = $(this).data('id')
        let name = $(this).data('name')
        let username = $(this).data('username')
        let email = $(this).data('email')
        let role = $(this).data('role')

        $('#id_u').val(id)
        $('#name_u').val(name)
        $('#password_u').val('')
        $('#username_u').val(username)
        $('#email_u').val(email)
        $('#role_u').val(role).trigger("change")
        $('#notif_u').append('');
    });
</script>
@endsection