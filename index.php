<?php 
include "header.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content ">
    <!-- Main content -->
    <section class="content"> 
        <div class="container">
            <h2 class="text-center display-4">Kitap Bulun</h2>
            <form action="" method="GET">
                <div class="row col-sm-12 col-md-12 col-lg-12 mt-3">
                    <div class="col-md-10 col-sm-12 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kitap Türü:</label>
                                    <select class="select2" name="kindSort" data-placeholder="Tümü" style="width: 100%;">
                                    <option></option>
                                      <?php 
                                        $turQuery = $db->query("SELECT * FROM category", PDO::FETCH_ASSOC);
                                        foreach($turQuery as $row){
                                          echo "<option value=". $row["categoryId"] .">". $row["categoryName"] ."</option>";
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Sıralama Türü:</label>
                                    <select class="select2" name="sorting" style="width: 100%;">
                                        <option value="ASC" >A - Z</option>
                                        <option value="DESC">Z - A</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="bookName" placeholder="Kitap adını girin (Tümü)">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default" name="btnSearch">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

      <!-- tablo baş -->
      <?php
      
      if(isset($_GET["btnSearch"])){ 
        $sorting = $_GET["sorting"];
        $kSort = $_GET["kindSort"];
        $bookName = $_GET["bookName"]; 
        if(empty($_GET["bookName"]) && empty($_GET["kindSort"])){
          $bookQuery = $db->query("SELECT * FROM booklist_view ORDER BY bookName {$sorting}", PDO::FETCH_ASSOC);
        }else if(empty($_GET["bookName"]) && isset($_GET["kindSort"])){
          $bookQuery = $db->query("SELECT * FROM booklist_view WHERE categoryId={$kSort} ORDER BY bookName {$sorting}", PDO::FETCH_ASSOC);
        }else if(isset($_GET["bookName"]) && empty($_GET["kindSort"])){
          $bookQuery = $db->query("SELECT * FROM booklist_view WHERE bookName LIKE '%{$bookName}%' ORDER BY bookName {$sorting}", PDO::FETCH_ASSOC);
        }else{
          $bookQuery = $db->query("SELECT * FROM booklist_view WHERE categoryId={$kSort} AND bookName LIKE '%{$bookName}%' ORDER BY bookName {$sorting}", PDO::FETCH_ASSOC);
        }
      ?>
        <div class="row m-auto align-items-center col-sm-12 col-md-11 col-lg-9">
          <div class="col-12 align-items-center">
            <div class="card col-12 align-items-center">
               
              <!-- /.card-header -->
              <div class="card-body align-items-center col-sm-12 col-md-10 col-lg-12">
                <table class="table">
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
                      <?php if(isset($_SESSION["login"])) echo "<th>İşlemler</th>"; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php 
                      foreach($bookQuery as $row){ 
                        echo "<tr>
                        <td>".$row["bookId"]."</td>
                        <td>".$row["bookName"]."</td>
                        <td>".$row["authorName"]."</td>
                        <td>".$row["categoryName"]."</td>
                        <td>".$row["numberOfPage"]."</td>
                        <td>".$row["yearOfPrinting"]."</td>
                        <td>".$row["lang"]."</td>
                        <td>".$row["publisherName"]."</td>";
                        if(isset($_SESSION["memberId"]))
                        {
                          $control = $db->query("SELECT * FROM favoritebooks WHERE bookId={$row['bookId']} AND memberId={$_SESSION['memberId']}", PDO::FETCH_ASSOC);
                          if($control->rowCount()){
                            echo "
                            <td>
                              <a href='member/index.php#favbook'><i title='Zaten Listede ♥ ' class='fas fa-heart'> </i></a>
                            </td></tr>";
                          }else{
                            echo "
                            <td>
                              <a href='controller/FavBookController.php?islem=i&id=".$row["bookId"]."'> <i title='Favorilere Ekle' class='far fa-heart'></i></a>
                            </td></tr>";
                          }
                        }
                      }
                       ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      <!-- tablo son -->
      <?php } ?>
      </section>
    </div>
    
  <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="dist/js/demo.js"></script> -->
<script>
    $(function () {
      $('.select2').select2()
    });
</script>
</body>
</html>
