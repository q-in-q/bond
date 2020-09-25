<?php

session_start();


if($_SESSION['status'] !="login"){
    header("location:admin.php");
}else{
    header("location:./dashboard/");
}

?>