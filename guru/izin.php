<?php

include '../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    $dt['message'] = "Gagal : Method Tidak Diizinkan";
    $dt['status'] = false;
} else {
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('Y-m-d H:i:s');
    $id_guru = $_POST['id_guru'];
    $id_admin = 1;
    $alasan = $_POST['alasan'];
    $file_name = $_FILES['file']['name'];
    $file = $_FILES['file']['tmp_name'];

    $target_dir = "..file/";
    $target_file = $target_dir . basename($file_name);

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'png', 'pdf', '.gif', 'jpeg'];

    if (!in_array($fileType, $allowedTypes)) {
        $dt['message'] = "Gagal: Tipe File Dilarang";
        $dt['status'] = false;
    } else {
        $tipe = "izin";
        $query = "insert into izin(id_admin, id_guru, waktu, alasan,file,  tipe) values($id_admin, $id_guru, '$waktu', '$alasan' ,'$file_name','$tipe')";
        $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if ($execute) {
            move_uploaded_file($file, '../file/' . $file_name);
            $dt['message'] = "Status: Izin";
            $dt['status'] = true;
        } else {
            $dt['message'] = "Gagal: Izin";
            $dt['status'] = false;
        }
    }
}
echo json_encode($dt);
