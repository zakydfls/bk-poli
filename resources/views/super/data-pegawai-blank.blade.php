@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content col-12" id="kt_content">
        <div class="card mb-8">
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <div class="fv-row mt-6 bb-4">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6">Pilih OPD</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select" data-control="select2" data-placeholder="Pilih OPD" id="opd" selected="true" required>
                        <option value="0">Pilih OPD</option>                                
                        @foreach ($opd as $o) 
                        <option value="{{$o->id_opd}}">{{$o->singkatan}}</option>                                
                        @endforeach
                    </select>
                </div>
            </div>
        </div>  
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
							<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Pencarian"/>
						</div>
						<!--end::Search-->						
					{{-- </div> --}}
				</div>
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
						<!--begin::Add customer-->
						<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" 
                        title="Tambah Data" id="btn_tambah">
							<i class="fa fa-plus fs-4"></i>
							Tambah
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
                            <th width="25%">NIP</th>
                            <th width="25%">Nama</th>
                            <th width="25%">Jabatan</th>
                            <th>Bidang</th>
                            <th>#</th>
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
</div>
@endsection

@section('modal')
@endsection

@section('js')
<script>   
    $('#btn_tambah').hide()   
        
    $('#opd').on("change", function(){  
        let opd_id = $(this).val();
        window.location.href = url+'/pegawai/'+opd_id
    });
</script>
@endsection