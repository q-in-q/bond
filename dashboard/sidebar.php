 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./index.php" class="brand-link">
      <center><span class="brand-text font-weight-light">Taabbud<b>Bond</b></span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview ">
              <a href="./" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                Daftar Layanan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="./simplequeue.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Queue</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="./queuetree.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Queue Tree</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="./laporansq.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan SQ</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="./laporanqt.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan QT</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview ">
              <a href="./userlist.php" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
              <a href="./log.php" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Log
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>