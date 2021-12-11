<?php
include "header.php";
include "sidebar.php"; 

if (isset($_POST["email"]))
{
  $kime = "senacaliskan03@gmail.com";
  $konu = $_POST["subject"]; 
  $mesaj = "<h3>".$_POST["message"]."</h3>";
  $baslik = "From: ".$_POST["name"]."<".$_POST["email"].">\r\n";
  $baslik .= "Reply-to: tcsenaclskn@gmail.com\r\n";
  $baslik .= "Content-type: text/html\r\n";
  $mail = mail($kime, $konu, $mesaj, $baslik);
  if($mail)
  {
    echo "Emailiniz basarivla gonderilmistir.";
  }
 
}
  
?>
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">Yeni Mesaj Oluştur</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" name="name" placeholder="Kime:"> 
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" placeholder="Konu:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="email" class="form-control" style="height: 300px">
                      
                                   
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Dosya Yükle
                    <input type="file" name="attachment">
                  </div>
                  <p class="ml-3 mt-1 text-secondary">  Max. 32MB</p>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i>  Taslak Kaydet</button>
                  <button type="submit" class="btn btn-primary" value="senacaliskan03@gmail.com"><i class="far fa-envelope"></i>  Gönder</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i>  Sayfayı Temizle</button>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
include "footer.php";

?>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
</body>
</html>
