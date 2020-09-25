<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$getQueue = $API->getQueue();
$data = $API->response;

$getSch = $API->getScheduler();

$id = $_POST['idsch'];
$queueName = $_POST['queueName'];
$date = DateTime::createFromFormat('Y-m-d', $_POST['date'])->format('M/d/Y');
$bw = $_POST['bandwidth'];
$bwupold = $_POST['bw'];
$tglup = $_POST['tglup'];
//Explode Date
$val = explode(" ",$date);

//Get resource
$getResource = $data['resource'];

foreach($getSch as $sch){
    if(strpos($sch['name'], "-SQ_DOWN") == true){
        $ex = explode("-", $sch['name']);        
        if($ex[0] == $queueName){
            //UPDATE
            $update = $conn->query($q->updateSqRun(DateTime::createFromFormat('M/d/Y', $date)->format('Y-m-d'), $bw, $queueName, DateTime::createFromFormat('M/d/Y', $tglup)->format('Y-m-d'), $bwupold));
            //ADD KONFIG
            //bw = bandwith terbaru, ex2 = bw down lama
            $sqdown = $API->editSqUpRun($id, $queueName, $bw);
            $squp = $API->editSqDownRun($queueName, $date, $ex[2], $bw);
            $queue = $API->editQueueRun($queueName, $bw);

            //LOG
            $nama = $_SESSION['nama'];
            $log = $conn->query($q->addlog($nama, "BondSQ $queueName berhasil diupdate oleh $nama"));
            break;  
        }
    }
}
?>
<script type="text/javascript">
    alert("Queue Berhasil Diupdate!");
    window.location.href="../dashboard/index.php?berhasil-update";
</script>