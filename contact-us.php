<?php
$contact = true;
include "header.php";
?>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content col-12">
      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5  d-flex align-items-center justify-content-center">
            <div class="text-center">
              <h2><strong>DS </strong>Kütüphane</h2>
              <p class="lead mb-5 text-muted">Since 2021 . . .<br>
               
              </p>
            </div>
          </div>
          <div class="col-6">
            <form action="controller/MailController.php" method="POST">
              <div class="form-group">
                <label for="inputName">Ad</label>
                <input type="text" id="inputName" name="name" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email" id="inputEmail" name="mail" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputSubject">Konu</label>
                <input type="text" id="inputSubject" name="subject" class="form-control" />
              </div>
              <div class="form-group">
                <label for="inputMessage">İleti</label>
                <textarea id="inputMessage" class="form-control" name="message" rows="4"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-info" value="İletiyi Gönder">
              </div>
            </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer  m-auto p-2 col-10">
    <div class="float-right">
      <b class="text-muted">Version</b>  <b class="text-muted">1.0</b>
    </div>
    <strong class="text-muted"> Kütüphane Otomasyonu   (Veri Tabanı 2021)  <a href="https://adminlte.io"> Github </a></strong> <strong class="text-muted"> Damla Alim - Sena Çalışkan </strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>