<?php

use Illuminate\Support\Facades\Route;

function rupiah($number)
{
  return number_format($number, 0, ',', '.');
}

function bulan_romawi($bulan) {
  $bulanRomawi = [
      '01' => 'I',
      '02' => 'II',
      '03' => 'III',
      '04' => 'IV',
      '05' => 'V',
      '06' => 'VI',
      '07' => 'VII',
      '08' => 'VIII',
      '09' => 'IX',
      '10' => 'X',
      '11' => 'XI',
      '12' => 'XII'
  ];
    return $bulanRomawi[$bulan];
}

function bulan_2digit($bulan) {
  $bulanRomawi = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  ];
    return $bulanRomawi[$bulan];
}

function bulan($bulan) {
  $bulanx = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
  ];
    return $bulanx[$bulan];
}

function bulan_angka($bulan) {
  $bulanx = [
      'Januari'   => 1,
      'Februari'  => 2,
      'Maret'     => 3,
      'April'     => 4,
      'Mei'       => 5,
      'Juni'      => 6,
      'Juli'      => 7,
      'Agustus'   => 8,
      'September' => 9,
      'Oktober'   => 10,
      'November'  => 11,
      'Desember'  => 12
  ];
    return $bulanx[$bulan];
}

function hari($tanggal)
{
  $day = date('D', strtotime($tanggal));
  $dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
  );
  return  $dayList[$day];
}

function tanggal_indo($tgl, $tampil_hari = false)
{
  $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
  $nama_bulan = array(
    1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
    "September", "Oktober", "November", "Desember"
  );
  $tahun = substr($tgl, 0, 4);
  $bulan = $nama_bulan[(int)substr($tgl, 5, 2)];
  $tanggal = substr($tgl, 8, 2);
  $text = "";
  if ($tampil_hari) {
    $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
    $hari = $nama_hari[$urutan_hari];
    $text .= $hari . ", ";
  }
  $text .= $tanggal . " " . $bulan . " " . $tahun;
  return $text;
}

function set_active($uri, $output = "active")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}

function set_here($uri, $output = "here")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}


function set_active2($uri, $output = "active2")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}


function set_active_bar($uri, $output = "active-bar")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}
function set_active_menu($uri, $output = "active-menu")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}

function set_true($uri, $output = "true")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}

function set_show($uri, $output = "show")
{
  if (is_array($uri)) {
    foreach ($uri as $u) {
      if (Route::is($u)) {
        return $output;
      }
    }
  } else {
    if (Route::is($uri)) {
      return $output;
    }
  }
}
