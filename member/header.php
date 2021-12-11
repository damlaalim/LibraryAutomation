<?php
session_start();
include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kütüphane</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini bg-light">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-light ml-3 ">
    <!-- Left navbar links -->
    <ul class="navbar-nav"> 
     <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Anasayfa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../contact-us.php" class="nav-link">İletişim</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../controller/log-out.php" class="nav-link">Çıkış Yap</a>
      </li> 
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> 
    </ul>
  </nav>
  <!-- /.navbar -->
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