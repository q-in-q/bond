<?php

$config = [
    'hostname' => '192.168.2.1', // IP Mikrotik
    'username' => 'g3dang', // Username Mikrotik
    'password' => 'g0reng', // Password Mikrotik
    'ssl' => true
];

$API = new ApiHandler($config); //Object APIHandler(PHP API Class)

?>