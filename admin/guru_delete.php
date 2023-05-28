<?php

include '../config/connect.php';

$id_guru = $_POST['id_guru'];

if(!empty($id_guru)){
	$sql = "DELETE FROM guru WHERE id_guru=$id_guru ";

	$query = mysqli_query($conn,$sql);

	$data['status'] = true;
	$data['message'] = 'Berhasil Hapus';
}else{
	$data['status'] = false;
	$data['message'] = 'Gagal Hapus';
}

print_r(json_encode($data));


?>