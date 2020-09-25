<?php
include ('../config/connection.php');
require ('../lib/ApiHandler.php');
include ('../config/conf-router.php');
    
$email = $_POST['email'];
$pass = md5($_POST['password']);

$query_login = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username='$email' AND password='$pass'" );
$cek_data = mysqli_num_rows($query_login);
if($cek_data == 1 && $API->connected)  {
    session_start();
    $data = mysqli_fetch_assoc($query_login);
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['username'] =$data['username'];
    $_SESSION['status'] = "login";


    header("location: ../dashboard");
} else{
    echo"<script language='javascript'> alert('Username atau password salah!');history.go(-1); </script>";
}

?>