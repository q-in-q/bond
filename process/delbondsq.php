<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$getSch = $API->getScheduler();

$queueName = $_POST['deluser'];
$bw = $_POST['bw-sq'];


foreach($getSch as $sch){
    $ex = explode("-", $sch['name']);
    $tgl = $sch['start-date'];
    $ex0 = $ex[0];
    if("$ex0-SQ_DOWN" == "$queueName-SQ_DOWN"){
        $delete = $conn->query($q->deleteSQ($queueName, DateTime::createFromFormat('M/d/Y', "$tgl")->format('Y-m-d')));;
    break;
    }
}
$API->setSQ($queueName, $bw);
$API->delSchUPSQ($queueName);
$API->delSchDOWNSQ($queueName);

$nama = $_SESSION['nama'];
$log = $conn->query($q->addlog($nama, "BondSQ $queueName berhasil dihapus oleh $nama"));


?>
<script type="text/javascript">
    alert("Queue Berhasil Dihapus!");
    window.location.href="../dashboard/index.php?berhasil-delete";
</script>