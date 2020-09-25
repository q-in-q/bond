<?php 
session_start();
session_destroy();



?>

<script type="text/javascript">
    alert("Berhasil Logout!");
    window.location.href="../admin.php";
</script>