<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<?php
	$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	?>
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ayen<sub>Medan</sub></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
	  
      <li class="nav-item <?php if ($curPageName == "home.php") echo "active"; ?>">
        <a class="nav-link" href="home.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php
    if (isset($_SESSION['role'])) {
      if (strpos($_SESSION['role'], "Administrasi") !== false) {
    ?>
	  <li class="nav-item <?php if ($curPageName == "add-data-murid.php" || $curPageName == "view-data-murid.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataMurid" aria-expanded="true" aria-controls="dataMurid">
          <i class="fas fa-user"></i>
          <span>Data Murid</span>
        </a>
        <div id="dataMurid" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="add-data-murid.php">Add Data Murid</a>
			<a class="collapse-item" href="view-data-murid.php">View Data Murid</a>
          </div>
        </div>
      </li>
	  <li class="nav-item <?php if ($curPageName == "add-data-tentor.php" || $curPageName == "view-data-tentor.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataTentor" aria-expanded="true" aria-controls="dataTentor">
          <i class="fas fa-user-graduate"></i>
          <span>Data Tentor</span>
        </a>
        <div id="dataTentor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="add-data-tentor.php">Add Data Tentor</a>
			<a class="collapse-item" href="view-data-tentor.php">View Data Tentor</a>
          </div>
        </div>
      </li>
	  <li class="nav-item <?php if ($curPageName == "kbm.php" || $curPageName == "view-jadwal-kbm.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwal" aria-expanded="true" aria-controls="jadwal">
          <i class="fas fa-calendar"></i>
          <span>Jadwal</span>
        </a>
        <div id="jadwal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="kbm.php">KBM</a>
			<a class="collapse-item" href="view-jadwal-kbm.php">View Jadwal KBM</a>
          </div>
        </div>
      </li>
    <li class="nav-item <?php if ($curPageName == "absensi-tentor.php") echo "active"; ?>">
      <a class="nav-link" href="absensi-tentor.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Absensi Tentor</span>
      </a>
    </li>
	  <li class="nav-item <?php if ($curPageName == "biaya-bimbingan.php" || $curPageName == "honor-tentor.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#biaya" aria-expanded="true" aria-controls="biaya">
          <i class="fas fa-hand-holding"></i>
          <span>Biaya</span>
        </a>
        <div id="biaya" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="biaya-bimbingan.php">Bimbingan</a>
			<a class="collapse-item" href="honor-tentor.php">Honor Tentor</a>
          </div>
        </div>
      </li>
	  <li class="nav-item <?php if ($curPageName == "pembayaran-murid.php" || $curPageName == "pembayaran-tentor.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembayaran" aria-expanded="true" aria-controls="pembayaran">
          <i class="fas fa-money-check-alt"></i>
          <span>Pembayaran</span>
        </a>
        <div id="pembayaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="pembayaran-murid.php">Pembayaran Murid</a>
			<a class="collapse-item" href="pembayaran-tentor.php">Honor Tentor</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?php if ($curPageName == "view-data-kantin.php" || $curPageName == "pembelian-kantin.php" || $curPageName == "hutang-kantin.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kantin" aria-expanded="true" aria-controls="kantin">
          <i class="fas fa-shopping-cart"></i>
          <span>Kantin</span>
        </a>
        <div id="kantin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="view-data-kantin.php">Daftar Kantin</a>
            <a class="collapse-item" href="pembelian-kantin.php">Pembelian</a>
            <a class="collapse-item" href="daftar-pembelian-kantin.php">Daftar Pembelian</a>
            <a class="collapse-item" href="hutang-kantin.php">Daftar Hutang</a>
          </div>
        </div>
      </li>
	  <li class="nav-item <?php if ($curPageName == "tambah-user.php" || $curPageName == "daftar-user.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kelolaUser" aria-expanded="true" aria-controls="kelolaUser">
          <i class="fas fa-user-cog"></i>
          <span>Kelola User</span>
        </a>
        <div id="kelolaUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="tambah-user.php">Tambah user</a>
			<a class="collapse-item" href="daftar-user.php">Daftar user</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?php if ($curPageName == "laporan-absensi-murid.php" || $curPageName == "laporan-absensi-tentor.php" || $curPageName == "stats-jumlah-murid.php" || $curPageName == "nilai-murid.php" || $curPageName == "laporan-bayaran-murid.php" || $curPageName == "laporan-bayaran-tentor.php") echo "active"; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
          <i class="fas fa-newspaper"></i>
          <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List:</h6>
            <a class="collapse-item" href="laporan-absensi-murid.php">Laporan Absensi Murid</a>
            <a class="collapse-item" href="laporan-absensi-tentor.php">Laporan Absensi Tentor</a>
            <a class="collapse-item" href="stats-jumlah-murid.php">Statistik Jumlah Murid</a>
            <a class="collapse-item" href="laporan-nilai-murid.php">Nilai Murid</a>
            <a class="collapse-item" href="laporan-bayaran-murid.php">Laporan Pembayaran Murid</a>
            <a class="collapse-item" href="laporan-bayaran-tentor.php">Laporan Pembayaran Tentor</a>
          </div>
        </div>
      </li>
      <?php
        }
        else if (strpos($_SESSION['role'], "Akademik") !== false) {
      ?>
      <li class="nav-item <?php if ($curPageName == "view-jadwal-tentor.php") echo "active"; ?>">
        <a class="nav-link" href="view-jadwal-tentor.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-clock"></i>
          <span>Jadwal Mengajar</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "absensi-murid.php") echo "active"; ?>">
        <a class="nav-link" href="absensi-murid.php">
          <i class="fas fa-clipboard-list"></i>
          <span>Absensi Murid</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "daftar-absen-tentor.php") echo "active"; ?>">
        <a class="nav-link" href="daftar-absen-tentor.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-clipboard-list"></i>
          <span>Daftar Absensi Tentor</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "input-nilai-murid.php") echo "active"; ?>">
        <a class="nav-link" href="input-nilai-murid.php">
          <i class="fas fa-star"></i>
          <span>Nilai Murid</span>
        </a>
      </li>
      <?php
        }
        else if (strpos($_SESSION['role'], "User") !== false) {
      ?>
      <li class="nav-item <?php if ($curPageName == "view-jadwal-murid.php") echo "active"; ?>">
        <a class="nav-link" href="view-jadwal-murid.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-clock"></i>
          <span>Jadwal</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "daftar-absen-murid.php") echo "active"; ?>">
        <a class="nav-link" href="daftar-absen-murid.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-clipboard-list"></i>
          <span>Daftar Absensi</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "daftar-nilai.php") echo "active"; ?>">
        <a class="nav-link" href="daftar-nilai.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-star"></i>
          <span>Daftar Nilai</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "detail-hutang.php") echo "active"; ?>">
        <a class="nav-link" href="detail-hutang.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-money-bill"></i>
          <span>Daftar Hutang</span>
        </a>
      </li>
      <li class="nav-item <?php if ($curPageName == "bukti-pembayaran.php") echo "active"; ?>">
        <a class="nav-link" href="bukti-pembayaran.php?id=<?= $_SESSION['id']; ?>">
          <i class="fas fa-glasses"></i>
          <span>Bukti Pembayaran</span>
        </a>
      </li>
      <?php
        }
      }
      ?>
	  
	  
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->