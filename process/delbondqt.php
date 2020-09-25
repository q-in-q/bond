<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$getSch = $API->getScheduler();
$queueName = $_POST['deluser'];
$tgl_mulai = DateTime::createFromFormat('M/d/Y', $_POST['tglqt'])->format('Y-m-d');
$bw = explode("-", $_POST['data-bw']);

foreach($getSch as $sch){
    $ex = explode("-", $sch['name']);
    $tgl = $sch['start-date'];
    $ex0 = $ex[0];
    if("$ex0-QT_DOWN" == "$queueName-QT_DOWN"){
        $del = $conn->query($q->deleteQT($queueName, $tgl_mulai));
        $API->delQueueUp($queueName, $bw[0], $bw[1]);
        $API->delQueueDown($queueName, $bw[2], $bw[3]);

        $API->delSchUPQT($queueName);
        $API->delSchDOWNQT($queueName);
    
        $nama = $_SESSION['nama'];
        $log = $conn->query($q->addlog($nama, "BondQT $queueName berhasil dihapus oleh $nama"));
        break;
    }
}

?>
<script type="text/javascript">
    alert("Queue Berhasil Dihapus!");
    window.location.href="../dashboard/index.php?berhasil-delete";
</script>