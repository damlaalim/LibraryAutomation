<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Profil</h1>
        <?php
            if(@$_GET["info"] == "error"){
                echo '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Uyarı!</h5>
                    Gerçekleştirmeye çalıştığınız işlem başarılamadı.
                </div>
                ';
            }else if(@$_GET["info"] == "successful"){
                echo '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Uyarı!</h5>
                    İşlem başarılı!
                </div>
                ';
            }
        ?>
        </div> 
    </div>
</div>
</section> 
<!-- /.content-wrapper -->
<?php   
    $problemQuery = $db->query("SELECT * FROM problemlist_view WHERE status = 1", PDO::FETCH_ASSOC);
    $solutionQuery = $db->query("SELECT * FROM problemlist_view WHERE status = 0", PDO::FETCH_ASSOC);
?>
                    
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#problem" data-toggle="tab">Çözülmemiş</a></li> 
                <li class="nav-item"><a class="nav-link" href="#solution" data-toggle="tab">Çözülmüş</a></li> 
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="active tab-content">
                <div class="active tab-pane" id="problem"> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Üye Id</th> 
                                <th style="width: 40px">Konu</th>
                                <th>Problem</th>
                                <th>Çözüm Durumu</th>
                                <th>Aktar</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php  
                                foreach($problemQuery as $row){ 
                                    echo 
                                    "<tr>
                                        <td>".$row["problemId"]."</td>
                                        <td>".$row["memberId"]."</td>
                                        <td>".$row["subject"]."</td>
                                        <td>".$row["problem"]."</td>
                                        <td>Çözülecek</td> 
                                        <td><a href='../controller/ProblemController.php?islem=aktarma&id=".$row["problemId"]."' class='badge badge-info'><i title='Sorun Çözüldü' class='fas fa-plus'></i></a></td>
                                    </tr>";                         
                                }
                            ?>  
                        </tbody>
                    </table>
                    
                </div> 
                <div class="tab-pane" id="solution">
                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Üye Id</th> 
                                <th>Admin Id</th>
                                <th style="width: 40px">Problem</th>
                                <th>Problem Açıklaması</th>
                                <th>Çözüm</th>
                                <th>Çözüm Durumu</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                            $status = "çözüldü";
                                foreach($solutionQuery as $row){ 

                                    if($row["status"]==1)
                                    {
                                        $status = "çözülecek";
                                    }
                                   
                                    echo 
                                    "<tr>
                                        <td>".$row["problemId"]."</td>
                                        <td>".$row["memberId"]."</td>
                                        <td>".$row["solutionId"]."</td> 
                                        <td>".$row["subject"]."</td>
                                        <td>".$row["problem"]."</td>
                                        <td>".$row["solution"]."</td>
                                        <td>".$status."</td> 
                                    </tr>";                         
                                }
                            ?>  
                        </tbody>
                    </table>
                     
            </div> <!-- /.tab-content -->  
            </div> 
          </div> <!-- /.card-body -->
        </div> <!-- /.card -->
      </div> <!-- /.col-sm-9 -->
    </div> <!-- /.row -->
  </div> <!-- /.container-fluid -->
</section>
<!-- /.content --> 
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
</div>

<!-- /.control-sidebar -->
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<?php
include "footer.php";
?>
</body>
</html>