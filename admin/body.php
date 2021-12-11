<?php
$query = $db->query("SELECT * FROM counters", PDO::FETCH_ASSOC);
$row = $query->fetch(PDO::FETCH_ASSOC);
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
  <!-- Small Box (Stat card) --> 
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3> <?php echo $row["bookCount"]; ?> </h3>

          <p>Kitap Sayımız</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-bar"></i>
        </div>
        <a href="#" class="small-box-footer">
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3> <?php echo $row["readBookCount"]; ?> </h3>

          <p>Okunan Kitap Sayısı</p>
        </div>
        <div class="icon">
          <i class="fas fa-book"></i>
        </div>
        <a href="#" class="small-box-footer">
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3> <?php echo $row["memberCount"]; ?> </h3>

          <p>Üye Sayımız</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <a href="#" class="small-box-footer">
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3> <?php echo $row["adminCount"]; ?> </h3>

          <p>Yönetici Sayımız</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-cog"></i>
        </div>
        <a href="#" class="small-box-footer">
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</section>

</div>
<!-- /.content-wrapper -->