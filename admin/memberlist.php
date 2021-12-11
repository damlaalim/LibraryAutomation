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
                <li class="nav-item"><a class="nav-link active" href="#member" data-toggle="tab">Üyeleri Listele</a></li> 
              <li class="nav-item"><a class="nav-link" href="#admin" data-toggle="tab">Yöneticileri Listele</a></li> 
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="active tab-content">
                <div class="active tab-pane" id="member">
                    <?php 
                        $memberquery = $db->query("SELECT memberId, memberName, mailAdress, avatar FROM member", PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fotoğraf</th>
                                <th>İsim</th>
                                <th style="width: 40px">Mail</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                foreach($memberquery as $row){
                                    echo 
                                    "<tr>
                                        <td>".$row["memberId"]."</td>
                                        <td><img class='profile-user-img img-fluid img-circle' 
                                        src='../upload/images/".$row["avatar"]."'></td>
                                        <td>".$row["memberName"]."</td>
                                        <td>".$row["mailAdress"]."</td>
                                    </tr>";
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="admin">
                    <?php 
                        $adminquery = $db->query("SELECT adminId, adminName, adminMail, avatar FROM admin", PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Fotoğraf</th>
                                <th>İsim</th>
                                <th style="width: 40px">Mail</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                foreach($adminquery as $row){
                                    echo 
                                    "<tr>
                                        <td>".$row["adminId"]."</td>
                                        <td><img class='profile-user-img img-fluid img-circle' 
                                        src='../upload/images/".$row["avatar"]."'></td>
                                        <td>".$row["adminName"]."</td>
                                        <td>".$row["adminMail"]."</td>
                                    </tr>";
                                }
                            ?>  
                        </tbody>
                    </table>
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