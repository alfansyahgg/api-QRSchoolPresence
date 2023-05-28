<?php

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] != "POST"){
    $dt['message'] = "Gagal : Method Tidak Diizinkan";  
    $dt['status'] = false; 
}else{
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('Y-m-d H:i:s');
    $jenis = $_POST['jenis'];
    $jenis = strtolower($jenis);
    $id_guru = $_POST['id_guru'];
    $id_admin = 1;
    $kode = $_POST['kode'];
    if(md5("presensitk") == $kode){
        switch ($jenis) {
            case 'hadir':
                $tipe = "hadir";
                $query = "insert into kehadiran(id_admin, id_guru, waktu, tipe) values($id_admin, $id_guru, '$waktu', '$tipe')";
                $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if($execute){
                    $dt['message'] = "Sukses: Berhasil Presensi Hadir";
                    $dt['status'] = true;
                }
                break;
            case 'pulang':
                $tipe = "pulang";
                $query = "insert into pulang(id_admin, id_guru, waktu, tipe) values($id_admin, $id_guru, '$waktu', '$tipe')";
                $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if($execute){
                    $dt['message'] = "Sukses: Berhasil Presensi Pulang";
                    $dt['status'] = true;
                }
                break;
            case 'terlambat':
                $tipe = "terlambat";
                $query = "insert into keterlambatan(id_admin, id_guru, waktu, tipe) values($id_admin, $id_guru, '$waktu', '$tipe')";
                $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if($execute){
                    $dt['message'] = "Status: Terlambat";
                    $dt['status'] = true;
                }
                break;
            case 'izin':
                $alasan = $_POST['alasan'];
                $tipe = "izin";
                $query = "insert into izin(id_admin, id_guru, waktu, alsaan, tipe) values($id_admin, $id_guru, '$waktu', '$alasan' ,'$tipe')";
                $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if($execute){
                    $dt['message'] = "Status: Izin";
                    $dt['status'] = true;
                }
                break;
            default:
                # code...
                break;
        }
    }else{
        $dt['message'] = "Gagal: Kode Rahasia Tidak Valid";
        $dt['status'] = false;
    }
    
}
    echo json_encode($dt);
?>