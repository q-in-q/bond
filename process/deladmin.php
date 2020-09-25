<?php
session_start();
require_once ('./function.php');

$q = new queryFunction();

$user = $_POST['deladmin'];

$insert = $conn->query($q->delAdmin($user));
$nama = $_SESSION['nama'];
$log = $conn->query($q->addlog($nama, "User $user berhasil dihapus oleh $nama"));

echo '<script type="text/javascript">
    alert("User Berhasil Dihapus!");
    window.location.href="../dashboard/userlist.php?Berhasil-dihapus";
    </script>';


?>