<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DS |  Üye Ol</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
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
  <div class="register-logo">
    <a href="index.php"><b>DS</b> KÜTÜPHANE</a>
  </div>

  <div class="card mt-4">
    <div class="card-body register-card-body bg-light">
      <h6 class="login-box-msg text-muted">Yeni üyelik oluşturun</h6>

      <form action="controller/RegisterController.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Tam isim" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name= "mail" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" placeholder="Şifre" minlength="8" maxlength="15" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="rePass"placeholder="Şifre tekrar" minlength="8" maxlength="15" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <div class="fw-lighter">
            Kaydolarak <a href="#" class="text-info">Kullanım Şartlarımızı </a> ve <a href="#" class="text-info">Gizlilik Politikamızı </a>  kabul etmiş olursunuz.
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 text-center mt-2 ">
            <button type="submit" name="btnKayit" class="btn btn-info btn-block">Kayıt ol</button>
          </div>
          <div class="col-12 text-center mt-2 ">
            <a href="login.php" class=" text-muted">Ben zaten üyeyim</a>
          </div>
          
          <!-- /.col -->
        </div>
      </form> 
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
