<?php

use App\Http\Controllers\BidangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\SignerController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Models\Bidang;
use App\Models\JadwalPeriksa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register/pasien', [LoginController::class, 'registrasi_pasien'])->name('register.post');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/poli', [PoliController::class, 'index'])->name('poli');
    Route::get('/poli/data', [PoliController::class, 'data'])->name('poli.data');
    Route::post('/poli/create', [PoliController::class, 'create'])->name('poli.create');
    Route::post('/poli/update', [PoliController::class, 'update'])->name('poli.update');
    Route::post('/poli/delete', [PoliController::class, 'destroy'])->name('poli.delete');

    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::get('/obat/data', [ObatController::class, 'data'])->name('obat.data');
    Route::post('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::post('/obat/update', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat/delete', [ObatController::class, 'destroy'])->name('obat.delete');

    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');
    Route::get('/dokter/data', [DokterController::class, 'data'])->name('dokter.data');
    Route::post('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter/update', [DokterController::class, 'update'])->name('dokter.update');
    Route::post('/dokter/delete', [DokterController::class, 'destroy'])->name('dokter.delete');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::get('/pasien/data', [PasienController::class, 'data'])->name('pasien.data');
    Route::post('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien/update', [PasienController::class, 'update'])->name('pasien.update');
    Route::post('/pasien/delete', [PasienController::class, 'destroy'])->name('pasien.delete');

    // jadwal periksa
    Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('jadwal-periksa');
    Route::get('/jadwal-periksa/data', [JadwalPeriksaController::class, 'data'])->name('jadwal-periksa.data');
    Route::post('/jadwal-periksa/create', [JadwalPeriksaController::class, 'store'])->name('jadwal-periksa.create');
    Route::post('/jadwal-periksa/update', [JadwalPeriksaController::class, 'update'])->name('jadwal-periksa.update');
    Route::post('/jadwal-periksa/delete', [JadwalPeriksaController::class, 'destroy'])->name('jadwal-periksa.delete');

    //DASHBOARD
    // Route::get('/grafik-bulanan', [DashboardController::class, 'grafikBulanan'])->name('grafikBulanan');
    // Route::get('/grafik-harian/{bulan}', [DashboardController::class, 'grafikHarian'])->name('grafikHarian');


    // Route::get('/data-user', [UserController::class, 'index'])->name('user.data');
    // Route::get('/get-user', [UserController::class, 'get_user'])->name('user.get');
    // Route::get('/get-user/byopd/{opd_id}', [UserController::class, 'get_user_super']);


    // //DINAS LUAR
    // Route::get('/dinas-luar', [DinasController::class, 'dinas_luar'])->name('dl');
    // Route::get('/dinas-luar/data', [DinasController::class, 'data_dl'])->name('dl.data');
    // Route::get('/dinas-luar/add', [DinasController::class, 'add_dl'])->name('dl.add');
    // Route::post('/dinas-luar/create', [DinasController::class, 'create_dl'])->name('dl.create');
    // Route::get('/dinas-luar/edit/{no_sp}', [DinasController::class, 'edit_dl'])->name('dl.edit');
    // Route::post('/dinas-luar/update', [DinasController::class, 'update_dl'])->name('dl.update');

    // //DINAS DALAM
    // Route::get('/dinas-dalam', [DinasController::class, 'dinas_dalam'])->name('dd');
    // Route::get('/dinas-dalam/data', [DinasController::class, 'data_dd'])->name('dd.data');
    // Route::get('/dinas-dalam/add', [DinasController::class, 'add_dd'])->name('dd.add');
    // Route::post('/dinas-dalam/create', [DinasController::class, 'create_dd'])->name('dd.create');
    // Route::get('/dinas-dalam/edit/{no_sp}', [DinasController::class, 'edit_dd'])->name('dd.edit');
    // Route::post('/dinas-dalam/update', [DinasController::class, 'update_dd'])->name('dd.update');

    // //CETAK
    // Route::post('/SPPD', [DinasController::class, 'sppd'])->name('sppd');
    // Route::post('/SP', [DinasController::class, 'sp'])->name('sp');
    // Route::get('/rekap', [DashboardController::class, 'rekap'])->name('rekap');
    // Route::get('/rekap/filter', [DashboardController::class, 'rekapFilter'])->name('rekapFilter');
    // Route::get('/rekap/{bulan}/{opd_id}', [DashboardController::class, 'rekapByBulan'])->name('rekapByBulan');
    // Route::get('/rekap/{bulan}', [DashboardController::class, 'rekapByBulan'])->name('rekapByBulan');


    // //SIGNER
    // Route::get('/signer', [SignerController::class, 'index'])->name('signer');
    // Route::post('/signer', [SignerController::class, 'create'])->name('signer.create');


    // //PEGAWAI
    // Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    // Route::get('/ajax/pegawai/data', [PegawaiController::class, 'data'])->name('pegawai.data');
    // Route::post('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    // Route::post('/pegawai/update', [PegawaiController::class, 'update'])->name('pegawai.update');
    // Route::get('/ajax/pegawai/del/{id}', [PegawaiController::class, 'delete'])->name('pegawai.delete');
    // Route::get('/cek-pegawai/{no_sp}/{keterangan}', [DinasController::class, 'cek_pegawai'])->name('cek_pegawai');
    // Route::get('/ajax/pegawai/data/byopd/{opd_id}', [PegawaiController::class, 'data_byopd'])->name('pegawai.data_byopd');
    // Route::post('/pegawai/create_byopd', [PegawaiController::class, 'create_byopd'])->name('pegawai.create_byopd');
    // Route::get('/pegawai/{opd_id}', [PegawaiController::class, 'index_byopd'])->name('pegawai.byopd');




    // //BIDANG
    // Route::get('/bidang', [BidangController::class, 'index'])->name('bidang');
    // Route::post('/bidang/create', [BidangController::class, 'create'])->name('bidang.create');
    // Route::post('/bidang/update', [BidangController::class, 'update'])->name('bidang.update');
    // Route::get('/ajax/bidang/del/{id}', [BidangController::class, 'delete'])->name('bidang.delete');
    // Route::get('/bidang/data', [BidangController::class, 'data'])->name('bidang.data');
    // Route::get('/bidang/byopd/{opd_id}', [BidangController::class, 'bidang_byopd'])->name('bidang.byopd');



    // //JABATAN
    // Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan');
    // Route::post('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    // Route::post('/jabatan/update', [JabatanController::class, 'update'])->name('jabatan.update');
    // Route::get('/ajax/jabatan/del/{id}', [JabatanController::class, 'delete'])->name('jabatan.delete');
    // Route::get('/jabatan/data', [JabatanController::class, 'data'])->name('jabatan.data');


    // Route::get('/ajax/cek-dinas/{pegawai_id}/{tgl}/{tgl_pulang}', [DinasController::class, 'cek_dinas'])->name('dinas.cek');
    // Route::get('/ajax/cek-dinas/{pegawai_id}/{tgl}/{tgl_pulang}/{no_sp}', [DinasController::class, 'cek_dinas2'])->name('dinas.cek2');
    // Route::get('/ajax/cek-sp/{no_sp}', [DinasController::class, 'cek_no_sp'])->name('no_sp.cek');
    // Route::get('/ajax/dinas-dalam/del/{no_sp}', [DinasController::class, 'delete_dd'])->name('dd.delete');
    // Route::get('/ajax/dinas-luar/del/{no_sp}', [DinasController::class, 'delete_dl'])->name('dl.delete');


    // // UPLOAD KOP
    // Route::get('/kop-surat', [SuratController::class, 'index'])->name('kop-surat');
    // Route::post('/kop-surat/upload', [SuratController::class, 'upload'])->name('kop-upload');





    // //AJAX
    // Route::post('/ajax/user/create', [UserController::class, 'create'])->name('user.create');
    // Route::post('/ajax/user/create_byopd', [UserController::class, 'create_byopd'])->name('user.create_by_opd');
    // Route::get('/ajax/user/cek/{cek}', [UserController::class, 'cek_username'])->name('user.cek');
    // Route::post('/ajax/user/delete/', [UserController::class, 'delete'])->name('user.delete');
    // Route::post('/ajax/user/update', [UserController::class, 'update'])->name('user.update');
});
