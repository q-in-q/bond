<?php
header('Content-Type: application/json');
// header('Content-Type: text/plain');

if(isset($_SESSION['status']) && !empty($_SESSION['status'])) {
    echo json_decode(['msg' => 'Dilarang!']);
    exit;
}

require_once '../lib/ApiHandler.php';
require_once '../config/conf-router.php';

$result = [];

if(isset($_GET['act']) && !empty($_GET['act']))  {
    $action = $_GET['act'];

    if ($action === 'dashboard') {
        $API->getRouterStatus();
        $result['data'] = $API->response['resource'];
    }
}else{
    $result['msg'] = 'Tidak ada Aksi';
}

echo json_encode($result);