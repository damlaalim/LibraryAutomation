<?php
$adminquery = $db->query("SELECT avatar, adminName FROM admin WHERE adminId = {$_SESSION['adminId']}", PDO::FETCH_ASSOC);
$admin = $adminquery->fetch(PDO::FETCH_ASSOC);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../upload/images/logo.png" alt="SD Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SD Kütüphane Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=<?php echo "../upload/images/".$admin["avatar"]; ?> alt="User profile picture">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $admin["adminName"] ?></a>
        </div>
      </div> 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="problem.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Sorunlar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="memberlist.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Üyeler</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="criminal.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Cezalar</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="mailbox.php" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>Mailler</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="booklist.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Kitaplar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="settings.php" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>Ayarlar</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>