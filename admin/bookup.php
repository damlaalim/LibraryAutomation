<?php
include "header.php";
include "sidebar.php";

$id = $_GET["id"];
$selectBook = $db->query("SELECT * FROM booklist_view WHERE bookId={$id}", PDO::FETCH_ASSOC);
$row = $selectBook->fetch(PDO::FETCH_ASSOC);

$author = $db->query("SELECT * FROM author ORDER BY authorName ASC", PDO::FETCH_ASSOC);
$category = $db->query("SELECT * FROM category ORDER BY categoryName ASC", PDO::FETCH_ASSOC);
$lang = $db->query("SELECT * FROM language ORDER BY lang ASC", PDO::FETCH_ASSOC);
$pub = $db->query("SELECT * FROM publisher ORDER BY publisherName ASC", PDO::FETCH_ASSOC);
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
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#update" data-toggle="tab">Kitap Güncelle</a></li>
                
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="active tab-content">
                <div class="active tab-pane" id="update">
                <form action="../controller/BookController.php?islem=update&id=<?php echo $id; ?>" method="POST">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kitap Adı</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="bName" value="<?php echo $row["bookName"]; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Yazar Adı</label>
                    <div class="col-sm-6">
                        <select name="aName" id="inputStatus" class="form-control custom-select">
                            <option selected="" value="<?php echo $row["authorId"]; ?>"><?php echo $row["authorName"]; ?></option>
                            <?php
                                foreach($author as $a){
                                    echo "<option value='".$a["authorId"]."'>".$a["authorName"]."</option>";
                                }
                            ?>
                        </select>  
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-6">
                        <select id="inputStatus" class="form-control custom-select" name="category">
                            <option selected="" value="<?php echo $row["categoryId"]; ?>"><?php echo $row["categoryName"]; ?></option>
                            <?php
                                foreach($category as $c){
                                    echo "<option value='".$c["categoryId"]."'>".$c["categoryName"]."</option>";
                                }
                            ?>
                        </select>    
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sayfa Sayısı</label>
                    <div class="col-sm-2">
                        <input type="number" id="inputEstimatedBudget" class="form-control" value="<?php echo $row["numberOfPage"]; ?>" step="1" name="page">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Basım Yılı</label>
                    <div class="col-sm-2">
                        <input type="number" id="inputEstimatedBudget" class="form-control" value="<?php echo $row["yearOfPrinting"]; ?>" step="1" max="2021" name="year">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dil</label>
                    <div class="col-sm-6">
                        <select id="inputStatus" class="form-control custom-select" name="lang">
                            <option selected="" value="<?php echo $row["langId"]; ?>"><?php echo $row["lang"]; ?></option>
                            <?php
                                foreach($lang as $l){
                                    echo "<option value='".$l["langId"]."'>".$l["lang"]."</option>";
                                }
                            ?>
                        </select>    
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Yayınevi</label>
                    <div class="col-sm-6">
                        <select id="inputStatus" class="form-control custom-select" name="pub">
                            <option selected="" value="<?php echo $row["publisherId"]; ?>"><?php echo $row["publisherName"]; ?></option>
                            <?php
                                foreach($pub as $p){
                                    echo "<option value='".$p["publisherId"]."'>".$p["publisherName"]."</option>";
                                }
                            ?>
                        </select>    
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Açıklama</label>
                    <div class="col-sm-6">
                        <textarea id="inputDescription" class="form-control" rows="4" name="description"><?php echo $row["description"]; ?></textarea>  
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-2">
                        <input type="number" id="inputEstimatedBudget" class="form-control" value="<?php echo $row["stock"]; ?>" min="1" step="1" name="stock">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                    </div> 
                </div>
                </div>
                </form>
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