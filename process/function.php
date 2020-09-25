<?php
include ('../config/connection.php');

date_default_timezone_set('asia/jakarta');
$date = date("M/d/Y H:m:s");

class queryFunction
{
    public function addlog($nama, $ket){
        date_default_timezone_set('asia/jakarta');
        $date = date("M/d/Y H:m:s");
        $q = "INSERT INTO tb_log(nama, keterangan) VALUES ('$nama', '$ket')";
        return $q;

    }
    public function getlog(){
        $q = "SELECT * FROM tb_log ORDER BY idlog desc";
        return $q;

    }

    public function addSQ($nama, $tanggal_awal, $tanggal_selesai, $bandwidth_awal, $bandwidth_up){
        $q = "INSERT INTO tb_simplequeue(nama, tanggal_mulai, tanggal_selesai, bandwidth_awal, bandwidth_up) VALUES ('$nama', '$tanggal_awal', '$tanggal_selesai', '$bandwidth_awal', '$bandwidth_up')";
        return $q;

    }

    public function updateSQ($tglup_mulai, $tglup_selesai, $bwup, $nama, $tglold, $bwupold){
        date_default_timezone_set('asia/jakarta');
        $date = date("M/d/Y H:m:s");
        $q = "UPDATE tb_simplequeue SET tanggal_mulai='$tglup_mulai', tanggal_selesai='$tglup_selesai', bandwidth_up='$bwup' WHERE nama='$nama' AND tanggal_selesai='$tglold' AND bandwidth_awal='$bwupold'";
        return $q;
    }

    public function deleteSQ($name, $tgl){
        $q = "DELETE FROM tb_simplequeue WHERE nama='$name' AND tanggal_selesai='$tgl'";
        return $q;

    }

    public function getuser($user){
        $q ="SELECT * FROM tb_admin WHERE NOT username='$user'";
        return $q;
    }

    public function getSQ(){
        $q ="SELECT * FROM tb_simplequeue ORDER BY idsq desc";
        return $q;
    }

    public function getQT(){
        $q ="SELECT * FROM tb_queuetree ORDER BY idqt desc";
        return $q;
    }

    public function addQT($nama, $tanggal_awal, $tanggal_selesai, $bwa_up, $bwa_down, $bwup, $bwdown){
        $q = "INSERT INTO tb_queuetree(nama, tanggal_mulai, tanggal_selesai, bandwidth_awal_up, bandwidth_awal_down, bandwidth_up, bandwidth_down) VALUES ('$nama', '$tanggal_awal', '$tanggal_selesai', '$bwa_up', '$bwa_down', '$bwup', '$bwdown')";
        return $q;

    }

    public function deleteQT($nama, $tgl){
        $q = "DELETE FROM tb_queuetree WHERE nama='$nama' AND tanggal_mulai='$tgl'";
        return $q;
    }

    public function adduser($nama, $user, $pass){
        $q = "INSERT INTO tb_admin(username, nama, password) VALUES('$user', '$nama', '$pass')";
        return $q;
    }

    public function delAdmin($user){
        $q = "DELETE FROM tb_admin WHERE username='$user'";
        return $q;
    }

    public function editAdmin($pass, $user){
        $q = "UPDATE tb_admin SET password='$pass' WHERE username='$user'";
        return $q;
    }

    public function countAdmin(){
        $q = "SELECT COUNT(username) FROM tb_admin";
        return $q;
    }

    public function updateSqRun($tgl, $bw, $nama, $tglmulai, $bwold){
        $q = "UPDATE tb_simplequeue SET tanggal_selesai='$tgl', bandwidth_up='$bw' WHERE nama='$nama' AND tanggal_mulai='$tglmulai' AND bandwidth_up='$bwold'";
        return $q;
    }

    public function updateQtRun($tgl, $bwup, $bwdown, $tgl_mulai, $nama){
        $q = "UPDATE tb_queuetree SET tanggal_selesai='$tgl', bandwidth_up='$bwup', bandwidth_down='$bwdown' WHERE nama='$nama' AND tanggal_mulai='$tgl_mulai'";
        return $q;
    }

    public function updateQt($tglmulai, $tglselesai, $bwup, $bwdown, $tgl_mulai, $nama){
        $q = "UPDATE tb_queuetree SET tanggal_mulai='$tglmulai', tanggal_selesai='$tglselesai', bandwidth_up='$bwup', bandwidth_down='$bwdown' WHERE nama='$nama' AND tanggal_mulai='$tgl_mulai'";
        return $q;
    }

}

// function addlog($nama, $ket){
    // date_default_timezone_set('asia/jakarta');
    // $date = date("M/d/Y H:m:s");
    // $addlog = mysqli_query($conn, "INSERT INTO tb_log (tanggal, nama, keterangan) values ($date, $nama, $ket)");
    // return $addlog;
// }
?>

