<?php


$date = $_POST['startDate'];
$val = explode(" ",$date);

echo $val[0];
echo "<br />";
echo $val[1];
echo "<br />";
echo $val[3];
echo "<br />";
echo $val[4];



// require ('../lib/ApiHandler.php');

// $config = [
//     'hostname' => '192.168.2.1',
//     'username' => 'g3dang',
//     'password' => 'g0reng',
//     'ssl' => true
// ];

// $API = new ApiHandler($config);
// $dev = $API->getQueue();
// $data = $API->response;


// $queueName = $_POST['queueName'];
// $startDate = $_POST['startDate'];
// $startTime = $_POST['startTime'];
// $endDate = $_POST['endDate'];
// $endTime = $_POST['endTime'];
// $bw = $_POST['bandwidth'];


// $getResource = $data['resource'];

// foreach ($getResource as $key)
// {
//     if($key['name'] == $queueName)
//     {
//         $limit = $key['max-limit'];
//         $down = $API->schedulerDown($queueName, $endDate, $endTime, $limit);
//         $up = $API->schedulerUp($queueName, $startDate, $startTime, $bw);
//         break;
//     }
// }
?>