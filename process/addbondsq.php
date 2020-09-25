<?php
session_start();
require_once ('../lib/ApiHandler.php');
require_once ('../config/conf-router.php');
require_once ('./function.php');

$q = new queryFunction();

$getQueue = $API->getQueue();
$data = $API->response;

$getSch = $API->getScheduler();


$exName = explode("|", $_POST['queueName']);
$date = $_POST['date'];
$bw = $_POST['bandwidth'];

//Explode Name Value
$id = $exName[0];
$name = $exName[1];
//Explode Date
$val = explode(" ",$date);
//Get resource
$getResource = $data['resource'];

foreach ($getQueue as $key)
{
    if(strpos($name, "-BOND") == true){
        echo '<script type="text/javascript">
            alert("Sudah Ada!");
            window.location.href="../dashboard/simplequeue.php?gagal-menambahkan";
        </script>';
        break;
    }else if($key['name'] == $name){
        $limit = $key['max-limit'];
        $down = $API->addSchDOWNSQ($id, $name, $val[3], $val[4], $limit, $bw);
        $up = $API->addSchUPSQ($name, $val[0], $val[1], $bw);
        $set = $API->setQueue($id, $name);
        //Add to DB
        $exBw = explode("/", $limit);
        $exUp = $API->formatBytes($exBw[0]);
        $exDown = $API->formatBytes($exBw[1]);
        $insert = $conn->query($q->addSQ($name, DateTime::createFromFormat('M/d/Y', $val[0])->format('Y-m-d'), DateTime::createFromFormat('M/d/Y', $val[3])->format('Y-m-d'), "$exUp/$exDown", $bw));

        //Log
        $nama = $_SESSION['nama'];
        $log = $conn->query($q->addlog($nama, "BondSQ $name berhasil ditambahkan oleh $nama"));

        echo '<script type="text/javascript">
        alert("Queue Berhasil Di Tambahkan!");
        window.location.href="../dashboard/simplequeue.php?berhasil-ditambahkan";
        </script>';
        break;
    }
}
?>
