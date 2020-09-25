<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$getQueue = $API->getQueueTree();
$data = $API->response;

$getSch = $API->getScheduler();

$id = $_POST['idsch'];
$queueName = $_POST['queueName'];
$date = DateTime::createFromFormat('Y-m-d', $_POST['date'])->format('M/d/Y');
//Bandwidth New
$bwup = $_POST['bw-up'];
$bwdown = $_POST['bw-down'];
// Bandwitdh UP OLD
$bwoldup = explode("/", $_POST['bwoldup']);
$bwolddown = explode("/", $_POST['bwolddown']);
$bwold = "$bwoldup[0]-$bwoldup[1]-$bwolddown[0]-$bwolddown[1]";

// Bandwidth DOWN Old
$bwdownold = $_POST['bwdown'];
$bwdownold_ex = explode("-", $bwdownold);

$tglup = DateTime::createFromFormat('M/d/Y', $_POST['tglup'])->format('Y-m-d');

//Explode bw
$exup = explode("/", $bwup);
$exdown = explode("/", $bwdown);
$bwnew  = "$exup[0]-$exup[1]-$exdown[0]-$exdown[1]";
//Get resource
$getResource = $data['resource'];

foreach($getSch as $sch){
    if(strpos($sch['name'], "-QT_DOWN") == true){
        $ex = explode("-", $sch['name']);        
        if($ex[0] == $queueName){
            //UPDATE
            $update = $conn->query($q->updateQtRun(DateTime::createFromFormat('M/d/Y', $date)->format('Y-m-d'), $bwup, $bwdown, $tglup, $queueName));
            
            // //ADD KONFIG
            $QTUp = $API->editSchQtUpRun($id, $queueName, $bwnew);
            $editQTUp = $API->editQtUpRun($queueName, $exup[0], $exup[1]);
            $editQTDown = $API->editQtDownRun($queueName, $exdown[0], $exdown[1]);
            $editSchDown = $API->editSchQtDownRun($queueName, $bwdownold, $date, $bwdownold_ex[0], $bwdownold_ex[1], $bwdownold_ex[2], $bwdownold_ex[3], $exup[0], $exup[1], $exdown[0], $exdown[1]);


            // //LOG
            $nama = $_SESSION['nama'];
            $log = $conn->query($q->addlog($nama, "BondSQ $queueName berhasil perpanjang / diupdate oleh $nama"));
            break;  
        }
    }
}
?>
<script type="text/javascript">
    alert("Queue Berhasil Diupdate!");
    window.location.href="../dashboard/index.php?berhasil-update";
</script>

