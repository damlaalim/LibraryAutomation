<?php
include "header.php";

if(!isset($_SESSION["memberName"])){
  header("Location: ../login.php");
}
$avatarquery = $db->query("SELECT avatar FROM member WHERE memberId = {$_SESSION['memberId']}", PDO::FETCH_ASSOC);
$avatar = $avatarquery->fetch(PDO::FETCH_ASSOC);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile ">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src=<?php echo "../upload/images/".$avatar["avatar"]; ?> 
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $_SESSION["memberName"]; ?></h3>

                <?php 
                  $memberId = $_SESSION["memberId"];
                  
                  $favquery = $db->query("SELECT * FROM favbooklist_view WHERE memberId = {$memberId}", PDO::FETCH_ASSOC);                  

                  $borrowingquery = $db->query("SELECT * FROM borrowlist_view WHERE memberId = {$memberId} AND deliveryControl = '1'", PDO::FETCH_ASSOC);   

                  $readquery = $db->query("SELECT * FROM borrowlist_view WHERE memberId = {$memberId} AND deliveryControl = '0'", PDO::FETCH_ASSOC);
                  
                  $memberquery = $db->query("SELECT * FROM member WHERE memberId = {$memberId}", PDO::FETCH_ASSOC);
                  $mrow = $memberquery->fetch(PDO::FETCH_ASSOC);

                  $criminalquery = $db->query("SELECT * FROM criminallist_view WHERE memberId = {$memberId}", PDO::FETCH_ASSOC);
                ?>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Okuduğum Kitaplar</b> <a class="float-right"><?php echo $borrowingquery->rowCount(); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Favorilerim</b> <a class="float-right"><?php echo $favquery->rowCount(); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Bitirdiğim Kitaplar</b> <a class="float-right"><?php echo $readquery->rowCount(); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Cezalarım</b> <a class="float-right">0</a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-info btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col col-lg-9">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#favbook" data-toggle="tab">Favori Kitaplarım</a></li>
                  <li class="nav-item"><a class="nav-link" href="#obook" data-toggle="tab">Okuduğum Kitaplarım</a></li>
                  <li class="nav-item"><a class="nav-link" href="#bbook" data-toggle="tab">Bitirdiğim Kitaplarım</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Bilgilerim</a></li>
                  <li class="nav-item"><a class="nav-link" href="#criminal" data-toggle="tab">Cezalarım</a></li>
                  <li class="nav-item"><a class="nav-link" href="#problem" data-toggle="tab">Sorun Bildir</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- favbook begin -->
                  <div class="active tab-pane" id="favbook">
                    <div class="card-body table-responsive p-0">
                      <table class="table table-sm table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Kitap</th>
                            <th>Yazar</th>
                            <th>Kategori</th>
                            <th>Sayfa Sayısı</th>
                            <th>Basım Yılı</th>
                            <th>Dil</th>
                            <th>Yayın Evi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php 
                            foreach($favquery as $favrow){
                              echo "<tr>
                              <td>".$favrow["bookId"]."</td>
                              <td>".$favrow["bookName"]."</td>
                              <td>".$favrow["authorName"]."</td>
                              <td>".$favrow["categoryName"]."</td>
                              <td>".$favrow["numberOfPage"]."</td>
                              <td>".$favrow["yearOfPrinting"]."</td>
                              <td>".$favrow["lang"]."</td>
                              <td>".$favrow["publisherName"]."</td>
                              <td><a href='../controller/FavBookController.php?islem=e&id=".$favrow["bookId"]."&fId=".$favrow["fbId"]."'class='badge badge-info'><i title='Kitabı Al' class='fas fa-plus'></i></a>
                              
                              <a href='../controller/FavBookController.php?islem=s&id=".$favrow["fbId"]."' class='badge badge-danger'><i title='Kitabı Kaldır' class='far fa-trash-alt'></i> </a></td>
                              </tr>";
                            }
                            ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- favbook end -->

                  <!-- obook begin -->

                  <div class="tab-pane" id="obook">
                    <div class="card-body table-responsive">
                      <table class="table  table-sm table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Kitap</th>
                            <th>Yazar</th>
                            <th>Kategori</th>
                            <th>Sayfa Sayısı</th>
                            <th>Basım Yılı</th>
                            <th>Dil</th>
                            <th>Yayın Evi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                            foreach($borrowingquery as $brow){
                              echo "<tr>
                              <td>".$brow["bookId"]."</td>
                              <td>".$brow["bookName"]."</td>
                              <td>".$brow["authorName"]."</td>
                              <td>".$brow["categoryName"]."</td>
                              <td>".$brow["numberOfPage"]."</td>
                              <td>".$brow["yearOfPrinting"]."</td>
                              <td>".$brow["lang"]."</td>
                              <td>".$brow["publisherName"]."</td>
                              <td><a href='../controller/FavBookController.php?islem=b&id=".$brow["borrowingId"]."' class='badge badge-info'> <i title='Kitabı Bitir' class='far fa-calendar-check'></i></a></td>
                              </tr>";
                            }
                            ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <!-- obook end -->
                  
                  <!-- bbook begin -->

                  <div class="tab-pane" id="bbook">
                    <div class="card-body table-responsive p-0">
                      <table class="table  table-sm table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Kitap</th>
                            <th>Yazar</th>
                            <th>Kategori</th>
                            <th>Sayfa Sayısı</th>
                            <th>Basım Yılı</th>
                            <th>Dil</th>
                            <th>Yayın Evi</th>
                            <th>İşlemler</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                              foreach($readquery as $rrow){
                                echo "<tr>
                                <td>".$rrow["bookId"]."</td>
                                <td>".$rrow["bookName"]."</td>
                                <td>".$rrow["authorName"]."</td>
                                <td>".$rrow["categoryName"]."</td>
                                <td>".$rrow["numberOfPage"]."</td>
                                <td>".$rrow["yearOfPrinting"]."</td>
                                <td>".$rrow["lang"]."</td>
                                <td>".$rrow["publisherName"]."</td>
                                <td> <a href='../controller/FavBookController.php?islem=k&id=".$rrow["borrowingId"]."' class='badge badge-danger'> <i title='Listeden Kaldır' class='far fa-trash-alt'></i> </a></td></tr>";
                              } 
                            ?> 
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <!-- bbook end -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="../controller/MemberController.php" method="POST" enctype="multipart/form-data">
                    <ul class="list-group list-group-flush text-info">
                    <li class="list-group-item m-1">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">İsim</label>
                          <div class="col-sm-10 col-md-8 col-lg-6">
                            <input type="text" class="form-control" id="inputName" name="name" value="<?php echo $mrow["memberName"]; ?>">
                          </div>
                        </div> 
                    
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label class="text-muted">
                              Onaylamak İçin Şifrenizi Girin
                            </label>
                          </div>
                        </div>
                      </div>
                    
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Şifre</label>
                        <div class="col-sm-10 col-md-8 col-lg-6">
                          <input type="password" class="form-control" id="inputSkills" placeholder="Şifre" name="pass">
                        </div>
                      </div> 
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary" name="nameBtn">Güncelle</button>
                        </div>
                      </div>
                    </li>
                      <!-- Fotoğraf Değiştirme Başlangıç -->
                      <li class="list-group-item m-1">
                      <div class="form-group">
                        <label for="exampleInputFile">Dosya Yükle</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="exampleInputFile">Fotoğraf Seç</label>
                          </div>
                          <div class="input-group-append">
                          <button type="submit" class="btn btn-secondary" name="imgBtn">Yükle</button>
                          </div>
                        </div>
                      </div>
                          </li>
                      <!-- Fotoğraf Değiştirme Son -->   
                      <!-- <ul class="list-group list-group-flush text-info"> -->
                         <li class="list-group-item ">
                           <label for="exampleInputFile"><a href="../recover-password.php">Şifremi Değiştir </a> </label>
                        </li>
                          <li class="list-group-item ">
                          <label for="exampleInputFile"><a href="../recover-mail.php">Mail Adresimi Değiştir </a> </label>
                          </li>
                         
                      </ul>
                      
                      
                    </form>
                  </div>

                  <!-- criminal -->
                  <div class="tab-pane" id="criminal">
                    <div class="card-body table-responsive">
                    <h4 class="text-secondary">NOT: Cezalar kitaplar teslim edildikten sonra hesaplanır.(19. günden sonra 1tl)</h4>
                    <form action="../controller/CriminalController.php" method="POST">
                      <table class="table  table-sm table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Kitap Id</th>
                            <th>Alınma Tarihi (YYYY-AA-GG)</th>
                            <th>Geri Getirme Tarihi (YYYY-AA-GG)</th>
                            <th>Ceza</th>  
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                            foreach($criminalquery as $crow){
                              echo "<tr>
                              <td>".$crow["bookId"]."</td>
                              <td>".$crow["borrowingDate"]."</td>
                              <td>".$crow["deliveryDate"]."</td>
                              <td>".$crow["criminal"]." tl</td> 
                              </tr>";
                            }
                            ?> 
                          </tr>
                        </tbody>
                      </table> 
                      <div class="form-group row">
                        <div class="offset-sm-10 col-sm-10">
                          <button type="submit" class="btn btn-secondary" name="criminalBtn">Cezalarını Güncelle</button>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>

                  <!-- /criminal -->
                  <!-- problem -->
                  <div class="tab-pane" id="problem">
                    <div class="card-body table-responsive p-0">
                      <form action="../controller/MemberController.php?islem=problem" method="POST">
                        <div class="form-group">
                      
                          <label class="text-secondary" for="inputSubject">Başlık</label>
                          <input type="text" id="inputSubject" name="subject" class="form-control" maxlength="50"/>
                        </div>
                        <div class="form-group">
                          <label class="text-secondary" for="inputMessage">Mesaj</label>
                          <textarea id="inputMessage" name="message" class="form-control" rows="4" maxlength="500"></textarea>
                        </div>
                        <div class="form-group">
                          <input type="submit" class="btn btn-info" name="button" value="Gönder">
                        </div>
                      </form>
                    </div>
                  </div>

                  <!-- /.tab-pane -->
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
  </div>
  <!-- /.content-wrapper -->
  <?php include "../footer.php"; ?>

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