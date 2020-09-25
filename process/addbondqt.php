<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');
$q = new queryFunction();

$dev = $API->getQueueTree();
$data = $API->response;

$getSch = $API->getScheduler();

$queueName = $_POST['queueName'];
$date = $_POST['Date'];
$bwUp = $_POST['bw-up'];
$bwDown = $_POST['bw-down'];

//Explode Date
$val = explode(" ",$date);

//Explode Name
$exName = explode("-",$queueName);

//Explode Bandwidth
$exUp = explode("/",$bwUp);
$exDown = explode("/",$bwDown);


//Get resource
$getResource = $data['resource'];
$getName = $exName[0];

foreach ($getResource as $queue)
{
    $exQueueName = explode("-", $queue['name']);
    if($exQueueName[0] == "$getName"){
        $limit_at = $queue['limit-at'];
        $max_limit = $queue['max-limit'];
        $down = $API->addSchDOWNQT($exName[0], $val[3], $val[4], $limit_at, $max_limit, $limit_at, $max_limit, $exDown[0], $exDown[1], $exUp[0], $exUp[1]);
        $up = $API->addSchUPQT($exName[0], $val[0], $val[1], $exDown[0], $exDown[1], $exUp[0], $exUp[1]);
        // $temp = $API->addSchTempQT($exName[0]);
        $temp = $API->setQueueDown($exName[0]);
        $temp = $API->setQueueUp($exName[0]);
        
        //Insert into database
        $nama = $_SESSION['nama'];
        $lim = $API->formatBytes($limit_at);
        $max = $API->formatBytes($max_limit);
        $insert = $conn->query($q->addQT($exName[0], DateTime::createFromFormat('M/d/Y', $val[0])->format('Y-m-d'), DateTime::createFromFormat('M/d/Y', $val[3])->format('Y-m-d'), "$lim/$max", "$lim/$max", $bwUp, $bwDown));
        $log = $conn->query($q->addlog($nama, "BondQT $exName[0] berhasil ditambahkan oleh $nama"));
        break;
    }
}
?>
<script type="text/javascript">
    alert("Berhasil Ditambahkan!");
    window.location.href="../dashboard/queuetree.php?berhasil-ditambahkan";
</script>