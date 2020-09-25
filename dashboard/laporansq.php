<?php
include('header.php');
include('sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
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
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#export">Export</button>
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="card-body" style="overflow-x:auto">
                    <table id="lapsq" class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">Bandwidth Awal</th>
                            <th class="text-center">Bandwidth Up</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($result = $conn->query($q->getSQ())){
                                while ($row = $result->fetch_assoc()){
                                    echo '
                                    <tr>
                                    <td align=center>'.$row['nama'].'</td>
                                    <td align=center>'.DateTime::createFromFormat('Y-m-d', $row['tanggal_mulai'])->format('M/d/Y').'</td>
                                    <td align=center>'.DateTime::createFromFormat('Y-m-d', $row['tanggal_selesai'])->format('M/d/Y').'</td>
                                    <td align=center>'.$row['bandwidth_awal'].'</td>
                                    <td align=center>'.$row['bandwidth_up'].'</td>
                                    </tr>
                                    ';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="export" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addModalQTLabel">Cetak Laporan BOND SQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="../process/cetaksq.php" method="POST">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Tanggal:</label>
                        <input type="text" name="tanggalcetak" class="form-control float-right" id="laporansq" required>                        
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div> 
        </div>
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('footer.php');
?>