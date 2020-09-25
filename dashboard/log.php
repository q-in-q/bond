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
            <div class="card-header">
            <h3 class="card-title">BOND Log</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="log" class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nama User</th>
                    <th class="text-center">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if($result = $conn->query($q->getlog())){
                        while ($row = $result->fetch_assoc()){
                            echo '
                            <tr>
                            <td align=center>'.$row['tanggal'].' '.$row['jam'].'</td>
                            <td align=center>'.$row['nama'].'</td>
                            <td>'.$row['keterangan'].'</td>
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
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('footer.php');
?>