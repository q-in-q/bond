<?php

$tlol = 'queue1-UP';

$explodeName = explode('-', $tlol);
list($nama_user, $updown) = $explodeName;

print_r $explodeName;

// include '../lib/ApiHandler.php';

// $config = [
//     'hostname' => '192.168.2.1',
//     'username' => 'g3dang',
//     'password' => 'g0reng',
//     'ssl' => true
// ];

// $api = new ApiHandler($config);
// $api->debug = true;

// $api->connect($config['hostname'], $config['username'], $config['password']);
// $api->write('/system/scheduler/print');

// header('Content-Type: text/plain');
// $data = $api->getScheduler();
// var_dump($data);

// echo $data['start-date'];

// echo PHP_EOL;

// $tmp = [];
// $user = 'A';
// $now = date('d-m-Y');
// echo $now;






// var_dump($tmp);

// $api->disconnect();

?>
<!-- <html>
<table border="2">
    <?php
        $pen = 0;
        $jln = 0;

        echo $jln;
        echo $pen;

        foreach ($data as $sch) {
            $tgl = $sch['start-date'];
            // $time = strtotime($tgl);
            // $new = datetime($time, 'd-m-Y');
            $new = DateTime::createFromFormat('M/d/Y', $tgl)->format('d-m-Y');
        
            $new1 = strtotime($new);
            $now1 = strtotime($now);
        
            $diff = ($now1 - $new1)/(60*60*24);
        
            echo "\n$diff\n";
            echo "\n$new"."\n";
        
        
            $scr = explode('-', $sch['name']);
            // var_dump($scr);
            list($nama_user, $updown) = $scr;
        
            if($new1 >= $now1 && $updown == "UP")
            {
                // $tmp = $nama_user . ' = ' . "Pending" . '  ' . $sch['name'];
                echo "<tr>";
                echo "<td>";
                echo $nama_user;
                echo "</td>";
                echo "<td>";
                echo "Pending";
                echo "</td>";
                echo "<td>";
                echo $sch['start-date'];
                echo "</td>";
                echo "<td>";
                echo $nama_user;
                echo "</td>";
                echo "</tr>";

                $pen = $pen + 1;
                
            }
            else if ($new1 <= $now1 && $updown == "UP")
            {
                //$new1 = Tanggal scheduler
                //$now1 = tanggal sekarang
                echo "<tr>";
                echo "<td>";
                echo $nama_user;
                echo "</td>";
                echo "<td>";
                echo "Jalan";
                echo "</td>";
                echo "<td>";
                echo $sch['start-date']; //Tanggal UP
                echo "</td>";
                echo "<td>";
                if($new1 > $now1 && $updown == "DOWN"){
                    
                    echo $sch['start-date']; //Rencana tanggal down
                    
                }
                echo "</td>";
                echo "</tr>";

                $jln = $jln + 1;
                // $tmp= $nama_user . ' = ' . "Jalan" . '  ' . $sch['name'];
            }
            
        
            // if($now <= $tgl && strtolower($updown) === 'up') {
            //     $tmp[] = $nama_user . ' = ' . "Pending" . '  ' . $sch['name'];
            // }
            // else if($now <= $tgl && strtolower($updown) === 'down') {
            //     $tmp[] = $nama_user . ' = ' . "Active" . '  ' . $sch['name'];
            // }
            // if($now <= $tgl && preg_match('/up/', $sch['name'], $basengmu)) {
            //     $tmp[] = $sch['name'];
            // }
        }
        
    ?>
    
</table>
        
</html> -->