<?php

include '../config/connect.php';

if($_SERVER['REQUEST_METHOD'] != "POST"){
    $dt['message'] = "Gagal : Method Tidak Diizinkan";  
    $dt['status'] = false; 
}else{
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn,stripslashes(strip_tags(htmlspecialchars($_POST['password']))));
    $password = md5($password);

    $query = "select * from guru where email='$email'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);

    $total_data = $result->num_rows;

    if($total_data > 0){
        if($password == $fetch['password']){
            $dt['message'] = "Sukses : Berhasil";  
            $dt['status'] = true; 
            $dt['data'] = $fetch;
            $dt['admin'] = false;
        }else{
            $dt['message'] = "Gagal : Password Salah";  
            $dt['status'] = false; 
        }
    }else{
        $dt['message'] = "Gagal : Email Tidak Ditemukan";  
        $dt['status'] = false; 
    }
}
    echo json_encode($dt);
?>