<?php
include "header.php";
include "sidebar.php"; 

$id=$_GET["id"];
$mailquery = $db->query("SELECT * FROM mail WHERE mailId={$id}", PDO::FETCH_ASSOC);
$row=$mailquery->fetch( PDO::FETCH_ASSOC);
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content mt-2">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
              Gönderen:  <?php echo $row["userName"]; ?></h3>
              <!-- <div class="card-tools">
                <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div> -->
            </div>

            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5> Konu: <?php echo $row["subject"];  ?> </h5>
            
                  <!-- <span class="mailbox-read-time float-right">mail tarih</span></h6> -->
              </div>

              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
                    <i class="fas fa-share"></i>
                  </button>
                </div> -->
                <!-- /.btn-group -->
                <!-- <button type="button" class="btn btn-default btn-sm" title="Print">
                  <i class="fas fa-print"></i>
                </button> -->
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>
                  <?php echo $row["message"];  ?>
                </p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            
            <!-- /.card-footer -->
            <!-- <div class="card-footer">
              <div class="float-right">
                
                <a href="../admin/mailWrite.php"><button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Cevapla</button></a>
                
              </div>
              <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Sil</button>
              <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Yazdır</button>
            </div> -->
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
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
