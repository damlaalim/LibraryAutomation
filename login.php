<?php
session_start();

if(isset($_SESSION["login"])){
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DS | Giriş Yap</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
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
  <div class="login-logo">
    <a href="index.php"><b>DS</b> KÜTÜPHANE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card mt-4">
    <div class="card-body login-card-body bg-light">
      <p class="login-box-msg text-muted"> Hesabınıza giriş yapın </p>

      <form action="controller/LoginController.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="mail" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Şifre" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center align-items-center">
         
          <!-- /.col -->
          <div class="col-10 mt-1 mb-1">
            <button type="submit" class="btn btn-info btn-block" name="loginBtn">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form> 
      <div class="card-footer text-center bg-light"> 
        <p class="">
          <a href="forgot-password.php" class="text-center text-info">  Şifremi unuttum</a>
        </p>
        <p class="">
          <a href="register.php" class="text-center text-info">Üyeliğiniz yok mu? Üye olun</a>
        </p>
      </div>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html> 