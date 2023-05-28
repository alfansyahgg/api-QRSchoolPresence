<?php

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] != "POST"){
    $dt['message'] = "Gagal : Method Tidak Diizinkan";  
    $dt['status'] = false; 
}else{
    $nama 		    = $_POST['nama'];
    $nohp	        = $_POST['nohp'];
    $email		    = $_POST['email'];
    $password 		= $_POST['password'];
    $password       = md5($password);

    if(!empty($nama)){
        $sql = "INSERT INTO guru (nama,nohp,email,password) VALUES('$nama','$nohp','$email','$password')";
        $query = mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn) > 0){
            $data['status'] = true;
            $data['message']	= "Berhasil";
        }else{
            $data['status'] = false;
            $data['message']	= "Gagal";
        }
    }
    else{
        $data['status'] = false;
        $data['message']	= "Gagal : Nama tidak boleh kosong!";
    }
}



print_r(json_encode($data));




?>