<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

// $getQueue = $API->getQueueTree();
// $data = $API->response;

$getSch = $API->getScheduler();

$id = $_POST['idschqt'];
$queueName = $_POST['queueName'];
$date = $_POST['date'];
$bwup = $_POST['bw-up'];
$bwdown = $_POST['bw-down'];
$tglold = DateTime::createFromFormat('M/d/Y', $_POST['tglold'])->format('Y-m-d');

//Explode Date
$val = explode(" ",$date);

//Explode BW
$exUp = explode("/",$bwup);
$exDown = explode("/",$bwdown);

//Explode Name
$exName = explode("-",$queueName);


// Get resource
// $getResource = $data['resource'];

foreach($getSch as $sch){
    if(strpos($sch['name'], "-QT_DOWN") == true){
        $ex = explode("-", $sch['name']);
        if($ex[0] == $queueName){
            $update = $conn->query($q->updateQt(DateTime::createFromFormat('M/d/Y', $val[0])->format('Y-m-d'), DateTime::createFromFormat('M/d/Y', $val[3])->format('Y-m-d'), $bwup, $bwdown, $tglold, $queueName));
            $down = $API->editSchDOWNQT($exName[0], $val[3], $val[4], $ex[2], $ex[3], $ex[4], $ex[5], $exUp[0], $exUp[1], $exDown[0], $exDown[1]);
            $up = $API->editSchUPQT($id, $exName[0], $val[0], $val[1], $exUp[0], $exUp[1], $exDown[0], $exDown[1]);

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