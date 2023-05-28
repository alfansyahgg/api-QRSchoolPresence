<?php

include '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] != "GET") {
    $dt['message'] = "Gagal : Method Tidak Diizinkan";
    $dt['status'] = false;
} else {
    date_default_timezone_set('Asia/Jakarta');
    $jenis = $_GET['jenis'];
    $jenis = strtolower($jenis);
    $qTipe = "AND tipe='$jenis'";
    $tanggal = $_GET['tanggal'] ? $_GET['tanggal'] : '0000-00-00';
    if ($tanggal != "0000-00-00") {
        $besok = date('Y-m-d', strtotime($tanggal . "+1 days"));
    } else {
        $besok = '9999-99-99';
    }
    switch ($jenis) {
        case 'semua':
            $qKehadiran = "select 
            kehadiran.id_kehadiran as id_presensi, kehadiran.id_admin, kehadiran.id_guru, kehadiran.waktu, kehadiran.tipe, guru.*
            from kehadiran inner join guru on kehadiran.id_guru = guru.id_guru where kehadiran.waktu >= '$tanggal' AND kehadiran.waktu < '$besok'";
            $qPulang = "select * from pulang inner join guru on pulang.id_guru = guru.id_guru where pulang.waktu >= '$tanggal' AND pulang.waktu < '$besok'";
            $qTerlambat = "select * from keterlambatan inner join guru on keterlambatan.id_guru = guru.id_guru where keterlambatan.waktu >= '$tanggal' AND keterlambatan.waktu < '$besok'";
            if (!empty($tipe)) {
                $qKehadiran .= $qTipe;
                $qPulang .= $qTipe;
                $qTerlambat .= $qTipe;
            }
            $query = $qKehadiran . " UNION " . $qPulang . " UNION " . $qTerlambat;
            $exec = mysqli_query($conn, $query);
            if (mysqli_num_rows($exec) > 0) {
                while ($row = mysqli_fetch_object($exec)) {
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            } else {
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
                $dt['data'] = [];
            }
            break;
        case 'hadir':
            $query = "select kehadiran.id_kehadiran as id_presensi, kehadiran.id_admin, kehadiran.id_guru, kehadiran.waktu, kehadiran.tipe, guru.* from kehadiran inner join guru on kehadiran.id_guru = guru.id_guru where kehadiran.waktu >= '$tanggal' AND kehadiran.waktu < '$besok'";
            $exec = mysqli_query($conn, $query);
            if (mysqli_num_rows($exec) > 0) {
                while ($row = mysqli_fetch_object($exec)) {
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            } else {
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
                $dt['data'] = [];
            }
            break;
        case 'pulang':
            $query = "select pulang.id_pulang as id_presensi, pulang.id_admin, pulang.id_guru, pulang.waktu, pulang.tipe, guru.* from pulang inner join guru on pulang.id_guru = guru.id_guru where pulang.waktu >= '$tanggal' AND pulang.waktu < '$besok'";
            $exec = mysqli_query($conn, $query);
            if (mysqli_num_rows($exec) > 0) {
                while ($row = mysqli_fetch_object($exec)) {
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            } else {
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
                $dt['data'] = [];
            }
            break;
        case 'terlambat':
            $query = "select keterlambatan.id_terlambat as id_presensi, keterlambatan.id_admin, keterlambatan.id_guru, keterlambatan.waktu, keterlambatan.tipe, guru.* from keterlambatan inner join guru on keterlambatan.id_guru = guru.id_guru where keterlambatan.waktu >= '$tanggal' AND keterlambatan.waktu < '$besok'";
            $exec = mysqli_query($conn, $query);
            if (mysqli_num_rows($exec) > 0) {
                while ($row = mysqli_fetch_object($exec)) {
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            } else {
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
                $dt['data'] = [];
            }
            break;
        case 'izin':
            $query = "select izin.id_izin as id_presensi, izin.id_admin, izin.id_guru, izin.waktu, izin.alasan, izin.tipe, izin.file, guru.* from izin inner join guru on izin.id_guru = guru.id_guru where izin.waktu >= '$tanggal' AND izin.waktu < '$besok'";
            $exec = mysqli_query($conn, $query);
            if (mysqli_num_rows($exec) > 0) {
                while ($row = mysqli_fetch_object($exec)) {
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            } else {
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
                $dt['data'] = [];
            }
            break;
        default:
            # code...
            break;
    }
}
echo json_encode($dt);
