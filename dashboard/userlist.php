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
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="addUser" data-toggle="modal" data-target="#addModalUser">Tambah User</button>
                </div>
                <div class="row">
                    <div class="card-body">
                        <table id="userlist" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 350px">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    </div>
                </div>
                <?php
                    if($result = $conn->query($q->getuser($_SESSION['username']))){
                        while ($row = $result->fetch_assoc()){
                            echo '
                            <tr>
                            <td align=center>'.$row['nama'].'</td>
                            <td align=center>'.$row['username'].'</td>
                            <td align=center>
                            <button type="button" class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#editModalUser" data-whatever="'.$row['username'].'" data-id="'.$row['nama'].'">
                                <i class="fas fa-edit"></i> 
                                Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModalUser" data-whatever="'.$row['username'].'">
                                <i class="fas fa-trash"></i> 
                                Delete
                            </button>
                            </td>
                            </tr>
                            ';
                        }
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="addModalUser" tabindex="-1" role="dialog" aria-labelledby="addModalUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addModalQTLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="../process/adduser.php" method="POST">
                    <div class="form-group">
                    <label for="nama" class="col-form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" name="user" id="user" placeholder="username" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="pass" id="pass" placeholder="password" required>
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
        <div class="modal fade" id="deleteModalUser" tabindex="-1" role="dialog" aria-labelledby="deleteModalUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabelUser">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="../process/deladmin.php" method="POST">
                    <div class="form-group">
                    <input type="hidden" id="deladmin" name="deladmin">
                    <p>Apakah anda yakin akan menghapus ?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="editModalUser" tabindex="-1" role="dialog" aria-labelledby="editModalUser" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editModalLabelUser">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form action="../process/editadmin.php" method="POST">
                    <div class="form-group">
                        <label for="Nama" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="Nama-id" name="Nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Username" class="col-form-label">Username</label>
                        <input type="text" class="form-control" id="Username-id" name="Username" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="Password" id="Password" required>
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
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('footer.php');
?>