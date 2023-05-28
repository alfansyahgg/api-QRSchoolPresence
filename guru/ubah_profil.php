<?php

include '../config/connect.php';

$id_guru 		    = $_POST['id_guru'];
$nama 		        = $_POST['nama'];
$nohp	            = $_POST['nohp'];
$email		        = $_POST['email'];
$password 		    = $_POST['password'];
$password       	= md5($password);
$tipe 				= $_POST['tipe'];

if (!empty($nama) && !empty($id_guru)) {

	if ($tipe == "guru") {
		$sql = "UPDATE guru set nama='$nama', nohp='$nohp', email='$email', password='$password' WHERE id_guru=$id_guru ";
	} else {
		$sql = "UPDATE admin set nama='$nama', nohp='$nohp', email='$email', password='$password' WHERE id_admin=$id_guru ";
	}

	$query = mysqli_query($conn, $sql);

	if (mysqli_affected_rows($conn) > 0) {
		$data['status'] = true;
		$data['message']	= "Berhasil";
	} else {
		$data['status'] = false;
		$data['message']	= "Gagal";
	}
} else {
	$data['status'] = false;
	$data['message']	= "Gagal : Nama tidak boleh kosong!";
}


print_r(json_encode($data));