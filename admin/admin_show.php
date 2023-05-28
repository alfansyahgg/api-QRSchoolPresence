<?php

include '../config/connect.php';

$id_guru = $_GET['id_guru'];

$sql = "SELECT * FROM guru where id_guru=$id_guru";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_object($query)) {
        $dt['status'] = true;
        $dt['message'] = "Sukses: Berhasil Ambil Data Guru";
        $dt['result'][] = $row;
    }
} else {
    $dt['status'] = false;
    $dt['result'][] = "Data not Found";
}

echo json_encode($dt);
