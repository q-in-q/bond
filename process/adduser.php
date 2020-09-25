<?php
session_start();
require_once ('./function.php');

$q = new queryFunction();

$nama = $_POST['nama'];
$user = $_POST['user'];
$pass = md5($_POST['pass']);

$cek_user = "select * from tb_admin where username='$_POST[user]'"; 
$prosescek= mysqli_query($conn, $cek_user);

if (mysqli_num_rows($prosescek)>0) { 
    echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
}
else {
    $insert = $conn->query($q->adduser($nama,$user, $pass));
    $nama = $_SESSION['nama'];
    $log = $conn->query($q->addlog($nama, "User $user baru berhasil ditambahkan oleh $nama"));
    echo '<script type="text/javascript">
    alert("User Berhasil Ditambahkan!");
    window.location.href="../dashboard/userlist.php?Berhasil-ditambahkan";
    </script>';
}
?>

