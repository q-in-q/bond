<?php
include ('header.php');
include ('sidebar.php'); 
require ('../lib/ApiHandler.php');
include ('../config/conf-router.php');

$getQueue = $API->getQueue();
$data = $API->response;

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Daftar Layanan</a></li>
            <li class="breadcrumb-item active">Simple Queue</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Simple Queue</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="../process/addbondsq.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Queue:</label>
                        <select class="form-control select2" name="queueName" style="width: 100%;" required>
                        <?php
                        $iface = $data['resource'];
                        foreach ($iface as $key) {
                                $interface = $key['name'];
                                $id = $key['.id'];
                                if($key['disabled'] == "false" && strpos($key['name'], "-BOND") == false){
                                    echo "<option value=\"$id|$interface\">$interface</option>";
                            }
                        }
                        ?> 
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>                              
                    <!-- ##### DATE PICKER ######-->
                    <div class="form-group">
                        <label>Tanggal Mulai - Selesai:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                            </div>
                            <input type="text" name="date" class="form-control float-right" id="reservationtime" required>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="jumlahbw">Jumlah Bandwidth (Upload/Download):</label>
                        <input type="text" class="form-control" name="bandwidth" id="jumlahbw" placeholder="10M/10M" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include ('footer.php');
?>
