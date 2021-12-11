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
                <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="tab">Kitapları Listele</a></li> 
                <li class="nav-item"><a class="nav-link" href="#bookinsert" data-toggle="tab">Kitap Ekle</a></li> 
                <li class="nav-item"><a class="nav-link" href="#authorinsert" data-toggle="tab">Yazar Ekle</a></li>
                <li class="nav-item"><a class="nav-link" href="#categoryinsert" data-toggle="tab">Kategori Ekle</a></li> 
                <li class="nav-item"><a class="nav-link" href="#langinsert" data-toggle="tab">Dil Ekle</a></li>
                <li class="nav-item"><a class="nav-link" href="#pubinsert" data-toggle="tab">Yayınevi Ekle</a></li> 

            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="active tab-content">
                <div class="active tab-pane" id="list">
                    <?php 
                        $bookquery = $db->query("SELECT * FROM booklist_view", PDO::FETCH_ASSOC);
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kitap Adı</th>
                                <th>Yazar Adı</th>
                                <th>Kategori</th>
                                <th>Sayfa Sayısı</th>
                                <th>Basım Yılı</th>
                                <th>Dil</th>
                                <th>Yayınevi</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                foreach($bookquery as $row){
                                    echo 
                                    "<tr>
                                        <td>".$row["bookId"]."</td>
                                        <td>".$row["bookName"]."</td>
                                        <td>".$row["authorName"]."</td>
                                        <td>".$row["categoryName"]."</td>
                                        <td>".$row["numberOfPage"]."</td>
                                        <td>".$row["yearOfPrinting"]."</td>
                                        <td>".$row["lang"]."</td>
                                        <td>".$row["publisherName"]."</td>
                                        <td><a href='../controller/BookController.php?islem=delete&id=".$row["bookId"]."' class='badge badge-danger'><i title='Kitabı Sil' class='far fa-trash-alt'></i></a>
                                        <a href='bookup.php?id=".$row["bookId"]."' class='badge badge-info'><i title='Güncelle' class='fas fa-plus'></i></a></td>
                                    </tr>";
                                }
                            ?>  
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="bookinsert">
                    <form action="../controller/BookController.php?islem=book" method="POST">
                        <?php
                            $author = $db->query("SELECT * FROM author ORDER BY authorName ASC", PDO::FETCH_ASSOC);
                            $category = $db->query("SELECT * FROM category ORDER BY categoryName ASC", PDO::FETCH_ASSOC);
                            $lang = $db->query("SELECT * FROM language ORDER BY lang ASC", PDO::FETCH_ASSOC);
                            $pub = $db->query("SELECT * FROM publisher ORDER BY publisherName ASC", PDO::FETCH_ASSOC);
                        ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kitap Adı</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="bName" placeholder="Kitap adı">
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Yazar Adı</label>
                            <div class="col-sm-6">
                                <select id="inputStatus" class="form-control custom-select" name="aName">
                                    <option selected="" disabled="">Seçiniz</option>
                                    <?php
                                        foreach($author as $row){
                                            echo "<option value='".$row["authorId"]."'>".$row["authorName"]."</option>";
                                        }
                                    ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <select id="inputStatus" class="form-control custom-select" name="category">
                                    <option selected="" disabled="">Seçiniz</option>
                                    <?php
                                        foreach($category as $row){
                                            echo "<option value='".$row["categoryId"]."'>".$row["categoryName"]."</option>";
                                        }
                                    ?>
                                </select>    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Sayfa Sayısı</label>
                            <div class="col-sm-2">
                                <input type="number" id="inputEstimatedBudget" class="form-control" value="100" step="1" name="page">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Basım Yılı</label>
                            <div class="col-sm-2">
                                <input type="number" id="inputEstimatedBudget" class="form-control" value="2021" step="1" max="2021" name="year">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Dil</label>
                            <div class="col-sm-6">
                                <select id="inputStatus" class="form-control custom-select" name="lang">
                                    <option selected="" disabled="">Seçiniz</option>
                                    <?php
                                        foreach($lang as $row){
                                            echo "<option value='".$row["langId"]."'>".$row["lang"]."</option>";
                                        }
                                    ?>
                                </select>    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Yayınevi</label>
                            <div class="col-sm-6">
                                <select id="inputStatus" class="form-control custom-select" name="pub">
                                    <option selected="" disabled="">Seçiniz</option>
                                    <?php
                                        foreach($pub as $row){
                                            echo "<option value='".$row["publisherId"]."'>".$row["publisherName"]."</option>";
                                        }
                                    ?>
                                </select>    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Açıklama</label>
                            <div class="col-sm-6">
                                <textarea id="inputDescription" class="form-control" rows="4" name="description"></textarea>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-2">
                                <input type="number" id="inputEstimatedBudget" class="form-control" value="1" min="1" step="1" name="stock">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="authorinsert">
                    <form action="../controller/BookController.php?islem=author" method="POST">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Yazar Adı</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="aName" placeholder="Yazar adı">
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="categoryinsert">
                    <form action="../controller/BookController.php?islem=category" method="POST">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="category" placeholder="Kategori">
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="langinsert">
                    <form action="../controller/BookController.php?islem=lang" method="POST">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Dil</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang" placeholder="Dil">
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="pubinsert">
                    <form action="../controller/BookController.php?islem=pub" method="POST">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Yayınevi Adı</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pub" placeholder="Yayınevi Adı">
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Merkez</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="center" placeholder="Merkez">
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                            </div> 
                        </div>
                    </form>
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