<?php
include ('header.php');
include ('sidebar.php');
require ('../lib/ApiHandler.php');
include ('../config/conf-router.php');

$getScheduler = $API->getScheduler();
$getStatus = $API->getRouterStatus();
$dataStats = $API->response;
$getClock = $API->getClock();
$dataClock = $API->response;
$snum = 1;
$qnum = 1;

$pending = 0;
$running = 0;

$realtime = true;

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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">System Date & Time</span>  
              <?php
                foreach($dataClock as $dat){
                  echo '<span class="info-box-text">'.$dat['date'].' <span id="time"> '. $dat['time'].'</span>';
                  echo '<span class="info-box-text">Timezone : '.$dat['timezone'].'</span>';
                }
                foreach($dataStats as $dat){
                  echo '<span class="info-box-text">Uptime : <span id="uptime">'.$dat['uptime'].'</span></span>';
                
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-info"></i></span>

            <div class="info-box-content">
              <?php
                
                  echo '<span class="info-box-text">Router Name : '.$dat['name'].'</span>';
                  echo '<span class="info-box-text">Model : '.$dat['board-name'].'</span>';
                  echo '<span class="info-box-text">RouterOS : '.$dat['version'].'</span>';
                  echo '<span class="info-box-text">Architecture : '.$dat['architecture'].'</span>';
                
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-database"></i></span>

            <div class="info-box-content">
              <?php
                  echo '<span class="info-box-text">CPU Load : <span id="cpu_load">'.$dat['cpu_load'].'</span></span>';
                  echo '<span class="info-box-text">CPU : '.$dat['cpu_name'].'</span>';
                  echo '<span class="info-box-text">Free Memory : <span id="memory">'.$dat['memory'].'</span></span>';
                  echo '<span class="info-box-text">Free HDD : <span id="hdd">'.$dat['hdd'].'</span></span>';
                }
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Simple Queue</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Queue Tree</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <div class="card-body">
                      <table id="sq" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th>Nama Queue</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">Bandwidth Up</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                          <?php
                            if($getScheduler == null){
                              echo '<tr><td colspan="7"><center>Tidak Ada Pengguna</center></td></tr>';
                            }else {
                              foreach($getScheduler as $dataSch){        
                                //Cek Date
                                if(strpos($dataSch['name'], "-SQ_DOWN") == true){
                                    $down = $dataSch['start-date'];
                                    $ex = explode("-", $dataSch['name']);
                                    $exBwDown = $ex;
                                  }
                                if(strpos($dataSch['name'], "-SQ_UP") == true){
                                    $up = $dataSch['start-date'];
                                    $ex = explode("-", $dataSch['name']);
                                    $exBw = $ex;
                                }

                                if(strpos($dataSch['name'], "-") == true){
                                  $explodeName = explode('-', $dataSch['name']);

                                  if($dataSch['run-count'] == "0" && $explodeName[1] == "SQ_UP" && $dataSch['disabled'] == "false"){
                                  echo '  <tr>
                                          <td align=center>'.$snum++.'</td>
                                          <td>'.$explodeName[0].'</<td>
                                          <td align=center>'.$up.'</<td>
                                          <td align=center>'.$down.'</<td>
                                          <td align=center>'.$exBw[2].'</<td>
                                          <td align=center><button type="button" class="btn btn-sm btn-warning" disabled>Pending</button></<td>
                                          <td align=center>
                                          <button type="button" class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#editModal" data-whatever="'.$explodeName[0].'" data-id="'.$dataSch['.id'].'" data-bw="'.$exBw[2].'">
                                            <i class="fas fa-edit"></i> 
                                            Edit
                                          </button>
                                          <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal" data-whatever="'.$explodeName[0].'" data-bw="'.$exBwDown[2].'">
                                            <i class="fas fa-trash"></i> 
                                            Delete
                                          </button>
                                          </td>
                                          </tr>';
                                  }else if ($dataSch['run-count'] == "1" && $explodeName[1] == "SQ_UP" && $dataSch['disabled'] == "false") {
                                    echo '  <tr>
                                          <td align=center>'.$snum++.'</td>
                                          <td>'.$explodeName[0].'</<td>
                                          <td align=center>'.$up.'</<td>
                                          <td align=center>'.$down.'</<td>
                                          <td align=center>'.$exBw[2].'</<td>
                                          <td align=center><button type="button" class="btn btn-sm btn-success" disabled>Running</button></<td>
                                          <td align=center>
                                          <button type="button" class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-tgl="'.DateTime::createFromFormat('M/d/Y', $down)->format('Y-m-d').'" data-target="#editModalRun" data-whatever="'.$explodeName[0].'" data-id="'.$dataSch['.id'].'" data-bw="'.$exBw[2].'" data-tglup="'.$up.'">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                          </button>
                                          <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModal" data-whatever="'.$explodeName[0].'" data-id="'.$dataSch['.id'].'" data-bw="'.$exBwDown[2].'">
                                            <i class="fas fa-trash"></i> 
                                            Delete
                                          </button>
                                          </td>
                                          </tr>';
                                  }
                                }
                              }
                            }
                          ?>             
                        </tbody>
                      </table>
                    </div>
                    <div class="modal fade" id="editModalRun" tabindex="-1" role="dialog" aria-labelledby="editModalRun" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalRunLabel">Edit BOND SQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/editbondsqrun.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="idsch" name="idsch">
                                <label for="queueName" class="col-form-label">Nama Queue:</label>
                                <input type="text" class="form-control" id="queueName" name="queueName" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Mulai - Selesai:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="hidden" id="tglup" name="tglup">
                                    <input type="date" name="date" id="date" class="form-control float-right" required>
                                  </div>
                                  <!-- /.input group -->
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Jumlah Bandwidth</label>
                                  <input type="hidden" id="bw" name="bw">
                                  <input type="text" class="form-control" name="bandwidth" id="bandwidth" placeholder="10M/10M" required>
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
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete BOND SQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/delbondsq.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="deluser" name="deluser">
                                <input type="hidden" id="idsch" name="idsch">
                                <input type="hidden" id="bw-sq" name="bw-sq">
                                <p>Apakah anda yakin akan menghapus queue ?</p>
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
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit BOND SQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/editbondsq.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="idsch" name="idsch">
                                <label for="queueName" class="col-form-label">Nama Queue:</label>
                                <input type="text" class="form-control" id="queueName" name="queueName" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Mulai - Selesai:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" name="date" class="form-control float-right" id="update_datepickersq" required>
                                  </div>
                                  <!-- /.input group -->
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Jumlah Bandwidth</label>
                                  <input type="text" class="form-control" name="bandwidth" id="bandwidth" placeholder="10M/10M" required>
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
                    <!-- /.card-body -->
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <div class="card-body" style="overflow-x:auto">
                      <table id="qt" class="table table-bordered table-striped ">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th>Nama Queue</th>
                            <th class="text-center">Tanggal Mulai</th>
                            <th class="text-center">Tanggal Selesai</th>
                            <th class="text-center">BW Upload</th>
                            <th class="text-center">BW Download</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                          if($getScheduler == null){
                            echo '<tr><td colspan="6"><center>Tidak Ada Pengguna</center></td></tr>';
                          }else {
                            foreach($getScheduler as $dataSch){                      
                              if(strpos($dataSch['name'], "-QT_DOWN") == true){
                                $down = $dataSch['start-date'];
                                $exName = explode("-", $dataSch['name']);
                                $exName = "$exName[2]-$exName[3]-$exName[4]-$exName[5]";
                                }
                                if(strpos($dataSch['name'], "-QT_UP") == true){
                                  $up = $dataSch['start-date'];
                                }

                              if(strpos($dataSch['name'], "-") == true){
                                $explodeName = explode('-', $dataSch['name']);
                                list($nama_user, $updown) = $explodeName;

                                // echo '<tr>';
                                if($dataSch['run-count'] == "0" && $updown == "QT_UP" && $dataSch['disabled'] == "false"){
                                echo '  <tr>
                                        <td align=center>'.$qnum++.'</td>
                                        <td>'.$nama_user.'</<td>
                                        <td align=center>'.$up.'</<td>
                                        <td align=center>'.$down.'</<td>
                                        <td align=center>'.$explodeName[2].'/'.$explodeName[3].'</<td>
                                        <td align=center>'.$explodeName[4].'/'.$explodeName[5].'</<td>
                                        <td align=center><button type="button" class="btn btn-sm btn-warning" disabled>Pending</button></<td>
                                        <td align=center>
                                        <button type="button" class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#editModalQT" data-whatever="'.$explodeName[0].'" data-id="'.$dataSch['.id'].'" data-bwup="'.$explodeName[2].'/'.$explodeName[3].'" data-bwdown="'.$explodeName[4].'/'.$explodeName[5].'" data-tglold="'.$up.'">
                                          <i class="fas fa-edit"></i>
                                          Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModalQT" data-whatever="'.$explodeName[0].'" data-tglold="'.$up.'" data-bw="'.$exName.'">
                                          <i class="fas fa-trash"></i> 
                                          Delete
                                        </button>
                                        </td>
                                        </tr>';
                                }else if ($dataSch['run-count'] == "1" && $updown == "QT_UP" && $dataSch['disabled'] == "false") {
                                echo '  <tr>
                                        <td align=center>'.$qnum++.'</td>
                                        <td>'.$nama_user.'</<td>
                                        <td align=center>'.$up.'</<td>
                                        <td align=center>'.$down.'</<td>
                                        <td align=center>'.$explodeName[2].'/'.$explodeName[3].'</<td>
                                        <td align=center>'.$explodeName[4].'/'.$explodeName[5].'</<td>
                                        <td align=center><button type="button" class="btn btn-sm btn-success" disabled>Running</button></<td>
                                        <td align=center>
                                        <button type="button" class="btn btn-sm btn-primary" title="Edit" data-toggle="modal" data-target="#editModalQTRun" data-tgl="'.DateTime::createFromFormat('M/d/Y', $down)->format('Y-m-d').'" data-whatever="'.$nama_user.'" data-bwup="'.$explodeName[2].'/'.$explodeName[3].'" data-bwdown="'.$explodeName[4].'/'.$explodeName[5].'" data-id="'.$dataSch['.id'].'" data-bwold="'.$exName.'" data-tglup="'.$up.'">
                                          <i class="fas fa-edit"></i>
                                          Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-sm btn-danger" title="Hapus" data-toggle="modal" data-target="#deleteModalQT" data-whatever="'.$explodeName[0].'" data-tglold="'.$up.'" data-bw="'.$exName.'">
                                          <i class="fas fa-trash"></i> 
                                          Delete
                                        </button>
                                        </td>
                                        </tr>';
                                }
                              }
                              // echo '</tr>';
                            }
                          }
                        ?>             
                        </tbody>
                      </table>
                    </div>
                    <div class="modal fade" id="deleteModalQT" tabindex="-1" role="dialog" aria-labelledby="deleteModalQT" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabelQT">Delete BOND QT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/delbondqt.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="deluser" name="deluser">
                                <input type="hidden" id="tglqt" name="tglqt">
                                <input type="hidden" id="data-bw" name="data-bw">
                                <p>Apakah anda yakin akan menghapus queue ?</p>
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
                    <div class="modal fade" id="editModalQT" tabindex="-1" role="dialog" aria-labelledby="editModalQT" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalQTLabel">Update BOND QT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/editbondqt.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="idschqt" name="idschqt">
                                <input type="hidden" id="tglold" name="tglold">
                                <label for="queueName" class="col-form-label">Nama Queue:</label>
                                <input type="text" class="form-control" id="queueName" name="queueName" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Mulai - Selesai:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" name="date" class="form-control float-right" id="update_datepickerqt" required>
                                  </div>
                                  <!-- /.input group -->
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Bandwidth Upload</label>
                                  <input type="text" class="form-control" name="bw-up" id="bw-up" placeholder="10M/10M" required>
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Bandwidth Download</label>
                                  <input type="text" class="form-control" name="bw-down" id="bw-down" placeholder="10M/10M" required>
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
                    <div class="modal fade" id="editModalQTRun" tabindex="-1" role="dialog" aria-labelledby="editModalQTRun" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalQTRunLabel">Update BOND QT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../process/editbondqtrun.php" method="POST">
                              <div class="form-group">
                                <input type="hidden" id="idsch" name="idsch">
                                <input type="hidden" id="bwdown" name="bwdown">
                                <input type="hidden" id="tglup" name="tglup">
                                <label for="queueName" class="col-form-label">Nama Queue:</label>
                                <input type="text" class="form-control" id="queueName" name="queueName" readonly>
                              </div>
                              <div class="form-group">
                                <label>Tanggal Selesai:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="date" name="date" class="form-control float-right" id="date" required>
                                  </div>
                                  <!-- /.input group -->
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Bandwidth Upload</label>
                                  <input type="hidden" name="bwoldup" id="bwoldup">
                                  <input type="text" class="form-control" name="bw-up" id="bw-up" required>
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Please fill out this field.</div>
                              </div>
                              <div class="form-group">
                                  <label for="bandwidth">Bandwidth Download</label>
                                  <input type="hidden" name="bwolddown" id="bwolddown">
                                  <input type="text" class="form-control" name="bw-down" id="bw-down" required>
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
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include ('footer.php');
?>
 