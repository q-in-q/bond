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
$date = $_POST['date'];
$bw = $_POST['bandwidth'];

//Explode Date
$val = explode(" ",$date);

//Get resource
$getResource = $data['resource'];


foreach($getSch as $sch){
    if(strpos($sch['name'], "-SQ_DOWN") == true){
        $ex = explode("-", $sch['name']);
        if($ex[0] == $queueName){
            //UPDATE
            $tglold = $sch['start-date'];
            $exBw = explode("/", $ex[2]);
            $exUP = $API->formatBytes($exBw[0]);
            $exDOWN = $API->formatBytes($exBw[1]);
            $update = $conn->query($q->updateSQ(DateTime::createFromFormat('M/d/Y', $val[0])->format('Y-m-d'), DateTime::createFromFormat('M/d/Y', $val[3])->format('Y-m-d'), $bw, $queueName, DateTime::createFromFormat('M/d/Y', "$tglold")->format('Y-m-d'), "$exUP/$exDOWN"));

            //ADD KONFIG
            $down = $API->editSchDOWNSQ($queueName, $val[3], $val[4], $ex[2], $bw);
            $up = $API->editSchUPSQ($id, $queueName, $val[0], $val[1], $bw);

            //LOG
            $nama = $_SESSION['nama'];
            $log = $conn->query($q->addlog($nama, "BondSQ $queueName berhasil update oleh $nama"));
            break;  
        }
    }
}
?>
<script type="text/javascript">
    alert("Queue Berhasil Diupdate!");
    window.location.href="../dashboard/index.php?berhasil-update";
</script>