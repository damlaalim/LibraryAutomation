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
        <h1>Profile</h1>
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
              <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Ayarlar</a></li>
              <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Şifremi Değiştir</a></li>
              <li class="nav-item"><a class="nav-link" href="#mail" data-toggle="tab">Mail Değiştir</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- setting -->
              <div class="active tab-pane" id="settings">
                  <form class="form-horizontal" action="../controller/AdminController.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">İsim</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $admin["adminName"]; ?>">
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            Onaylamak İçin Şifrenizi Girin
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Şifre</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputSkills" placeholder="Şifre" name="pass">
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger" name="nameBtn">Güncelle</button>
                      </div>
                    </div>
                    <!-- Fotoğraf Değiştirme Başlangıç -->
                    <div class="form-group">
                      <label for="exampleInputFile">Dosya Yükle</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="image" accept=".jpg, .jpeg, .png">
                          <label class="custom-file-label" for="exampleInputFile">Fotoğraf Seç</label>
                        </div>
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-danger" name="imgBtn">Yükle</button>
                        </div>
                      </div>
                    </div>
                    <!-- Fotoğraf Değiştirme Son -->   
                  </form>
                </div> 
              <!-- /setting -->
              <!-- password -->
              <div class="tab-pane" id="password">
                <form action="../controller/RecoverPasswordController.php" method="POST">
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="newpass" placeholder="Yeni Şifre">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="repass" placeholder="Şifreyi Onayla">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="pass" placeholder="Eski Şifreniz">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary btn-block">Şifreyi değiştir</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form> 
              </div>
              <!-- /password -->
              <!-- mail -->
              <div class="tab-pane" id="mail">
                <form action="../controller/RecoverMailController.php" method="POST">
                  <div class="input-group mb-3">
                    <input type="email" class="form-control" name="mail" placeholder="Yeni Mail Adresiniz">
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="pass" placeholder="Şifrenizi Girin">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
              <!-- /mail -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
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