<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$queueName = $_POST['deluser'];


$API->delSchUPSQ($queueName);
$API->delSchDOWNSQ($queueName);

$nama = $_SESSION['nama'];
$log = $conn->query($q->addlog($nama, "BondSQ $queueName berhasil dihapus oleh $nama"));


?>
<script type="text/javascript">
    alert("Queue Berhasil Dihapus!");
    window.location.href="../dashboard/index.php?berhasil-delete";
</script>