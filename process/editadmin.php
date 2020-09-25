<?php
session_start();
require_once ('./function.php');

$q = new queryFunction();

$user = $_POST['Username'];
$pass = md5($_POST['Password']);

$insert = $conn->query($q->editAdmin($pass, $user));
$nama = $_SESSION['nama'];
$log = $conn->query($q->addlog($nama, "User $user berhasil diupdate oleh $nama"));

echo '<script type="text/javascript">
    alert("User Berhasil Diupdate!");
    window.location.href="../dashboard/userlist.php?Berhasil-diupdate";
    </script>';

?>