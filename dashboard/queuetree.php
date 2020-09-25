<?php
include ('./header.php');
include ('./sidebar.php'); 
require ('../lib/ApiHandler.php');
include ('../config/conf-router.php');

$getQueue = $API->getQueueTree();
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
            <li class="breadcrumb-item active">Queue Tree</li>
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
            <h3 class="card-title">BOND Queue Tree</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="../process/addbondqt.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Queue</label>
                        <select class="form-control select2" name="queueName" style="width: 100%;" required>
                        <?php
                           $iface = $data['resource'];
                           if($getQueue['disabled'] == false) {
                            foreach ($iface as $key) {
                                $interface = $key['name'];
                                $exName = explode("-", $interface);
                                $exName = $exName[0];
                                if($key['disabled'] == "false" && strpos($key['name'], "_BOND") == false && strpos($key['name'], "-Down") == true){
                                    echo "<option value=\"$interface\">$exName</option>";  
                                }
                            }
                           }
                        ?> 
                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- ##### DATE PICKER ######-->
                            <div class="form-group">
                                <label>Tanggal Mulai - Selesai:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" name="Date" class="form-control float-right" id="reservationtime" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- ##### DATE PICKER ######-->
                            <div class="form-group">
                            <label for="Bandwith">Bandwidth Upload(limit-at/max-limit)</label>
                            <input type="text" class="form-control" name="bw-down" id="badwidth" placeholder="10M/10M" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- ##### DATE PICKER ######-->
                            <div class="form-group">
                            <label for="Bandwith">Bandwidth Download(limit-at/max-limit)</label>
                            <input type="text" class="form-control" name="bw-up" id="badwidth" placeholder="10M/10M" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    
                    </div>
                    <div class="card-footer">
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
include ('./footer.php');
?>
