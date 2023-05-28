<?php

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] != "GET"){
    $dt['message'] = "Gagal : Method Tidak Diizinkan";  
    $dt['status'] = false; 
}else{
    date_default_timezone_set('Asia/Jakarta');
    $jenis = $_GET['jenis'];
    $jenis = strtolower($jenis);
    $id_guru = $_GET['id_guru'];
    switch ($jenis) {
        case 'semua':
            $query = "select kehadiran.id_kehadiran as id_presensi, kehadiran.id_admin, kehadiran.id_guru, kehadiran.waktu, kehadiran.tipe from kehadiran
                UNION 
                SELECT * from pulang
                UNION 
                SELECT * from keterlambatan";
            $exec = mysqli_query($conn,$query);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_object($exec)){
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            }else{
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
            }
            break;
        case 'hadir':
            $query = "select kehadiran.id_kehadiran as id_presensi, kehadiran.id_admin, kehadiran.id_guru, kehadiran.waktu, kehadiran.tipe from kehadiran where id_guru = $id_guru";
            $exec = mysqli_query($conn,$query);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_object($exec)){
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            }else{
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
            }
            break;
        case 'pulang':
            $query = "select pulang.id_pulang as id_presensi, pulang.id_admin, pulang.id_guru, pulang.waktu, pulang.tipe from pulang where id_guru = $id_guru";
            $exec = mysqli_query($conn,$query);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_object($exec)){
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            }else{
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
            }
            break;
        case 'terlambat':
            $query = "select keterlambatan.id_terlambat as id_presensi, keterlambatan.id_admin, keterlambatan.id_guru, keterlambatan.waktu, keterlambatan.tipe from keterlambatan where id_guru = $id_guru";
            $exec = mysqli_query($conn,$query);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_object($exec)){
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            }else{
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
            }
            break;
        case 'izin':
            $query = "select izin.id_izin as id_presensi, izin.id_admin, izin.id_guru, izin.waktu, izin.alasan, izin.tipe, izin.file from izin where id_guru = $id_guru";
            $exec = mysqli_query($conn,$query);
            if(mysqli_num_rows($exec) > 0){
                while($row = mysqli_fetch_object($exec)){
                    $dt['message'] = "Sukses: Berhasil Ambil Data";
                    $dt['status'] = true;
                    $dt['data'][] = $row;
                }
            }else{
                $dt['message'] = "Sukses: Data Kosong";
                $dt['status'] = true;
            }
            break;
        default:
            # code...
            break;
    }
    
}
    echo json_encode($dt);
