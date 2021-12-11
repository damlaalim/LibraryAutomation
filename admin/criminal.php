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
        <h1>Profile</h1>
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

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-sm-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#criminal" data-toggle="tab">Cezalar</a></li> 
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="active tab-content">
                <div class="active tab-pane" id="criminal">
                    <?php 
                        $criminalQuery = $db->query("SELECT * FROM criminallist_view", PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>İsim</th> 
                                <th style="width: 40px">Mail</th>
                                <th>Kitap Id</th>
                                <th>Ödünç Alınan Tarih</th>
                                <th>Geri Getirilen Tarih</th>
                                <th>Ceza</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                foreach($criminalQuery as $row){
                                    echo 
                                    "<tr>
                                        <td>".$row["memberId"]."</td>
                                        <td>".$row["memberName"]."</td>
                                        <td>".$row["mailAdress"]."</td>
                                        <td>".$row["bookId"]."</td>
                                        <td>".$row["borrowingDate"]."</td>
                                        <td>".$row["deliveryDate"]."</td>
                                        <td>".$row["criminal"]." tl</td>
                                    </tr>";
                                }
                            ?>  
                        </tbody>
                    </table>
                    <form action="../controller/CriminalController.php" method="POST">
                        <div class="form-group row">
                        <div class="offset col-sm-10">
                            <button type="submit" class="btn btn-secondary" name="criminalAllBtn">Cezaları Güncelle</button>
                        </div>
                        </div>
                    </form>
                </div> 
            </div> <!-- /.tab-content -->   
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