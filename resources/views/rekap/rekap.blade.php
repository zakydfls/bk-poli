@extends('layouts.template')
@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content col-12" id="kt_content">
        @if (Auth::user()->role == 'super')
        <div class="card mb-8">
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <div class="fv-row mt-6 bb-4">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6">Pilih OPD</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select" data-control="select2" data-placeholder="Pilih OPD" id="opd"
                        selected="true" required>
                        <option value="0">Pilih OPD</option>
                        @foreach ($opd as $o)
                        <option value="{{$o->id_opd}}">{{$o->singkatan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="card">
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <div class="fv-row mt-6 mb-0">
                    <!--begin::Label-->
                    <label class="required fw-bold fs-6 mb-2">Pilih Bulan</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="hidden" id="bulan_now" value="{{$bulan_now}}">
                    <select class="form-select" data-control="select2" data-placeholder="Pilih Bulan" id="bulan"
                        selected="true" required>
                        @foreach ($bulan as $angka => $bulan)
                        <option value="{{$angka}}">{{$bulan}}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>
            <br>
            <!--end::Datatable-->
        </div>

        <div class="card mt-6">
            <!--begin::Datatable-->
            <div class="card-body pt-0">
                <div class="fv-row mt-10 mb-10">
                    <table class="table table-row-bordered gy-5" id="data_table" width="100%">
                        <thead>
                            <tr class="fw-bold fs-6 text-muted">
                                <th width="3%">No</th>
                                <th width="30%">Nama Pegawai</th>
                                @for ($i = 1; $i < $jml_hari; $i++) <th>{{$i}}</th>
                                    @endfor
                                    <th>DD</th>
                                    <th>DL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach ($dinas as $p)
                            @php
                            $dd = 0;
                            $dl = 0;
                            @endphp
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$p->nama}}</td>
                                @for ($i = 1; $i < $jml_hari; $i++) @php $x='x' .$i; @endphp @if ($p->dinas[0]->$x ==
                                    'Dinas Luar')
                                    @php
                                    $dl = $dl+1
                                    @endphp
                                    <td><span class="badge badge-danger">DL</span></td>
                                    @elseif ($p->dinas[0]->$x == 'Dinas Dalam')
                                    @php
                                    $dd = $dd+1
                                    @endphp
                                    <td><span class="badge badge-info">DD</span></td>
                                    @else
                                    <td>-</td>
                                    @endif
                                    @endfor
                                    <td>{{$dd}}</td>
                                    <td>{{$dl}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <!--end::Datatable-->
        </div>
    </div>
    <!--end::Post-->
</div>
@endsection
@section('js')
<script>
    $('#data_table').dataTable({
        "searching": true,
        "scrollX": true
    });

    let bulan = $('#bulan_now').val();
    let opd = $('#opd').val();


    let path = window.location.pathname.split('/');
    let opd_id_from_url = path[path.length - 1]; 

    if (opd_id_from_url) {
        $('#opd').val(opd_id_from_url).trigger('change'); 
    }


    if (bulan != 0) {
        $('#bulan').val(bulan).trigger('change');
    }

    console.log(bulan);
    console.log(opd);


    $('#bulan').on("change", function() { 
        let bulan = $(this).val();
        let opd_id = $('#opd').val(); 
        console.log(opd_id);
        if (opd_id == undefined || opd_id == 0) {
            var newURL = url + '/rekap/' + bulan;
        } else{
            var newURL = url + '/rekap/' + bulan + '/' + opd_id; 
        }
        window.location.href = newURL; 
    });


    $('#opd').on("change", function() {
        let opd_id = $(this).val();
        let bulan = $('#bulan').val();
        if (opd_id == undefined || opd_id == 0) {
            var newURL = url + '/rekap/' + bulan;
        } 
        var newURL = url + '/rekap/' + bulan + '/' + opd_id;

        window.location.href = newURL; 
    });
</script>

@endsection