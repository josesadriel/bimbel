			<!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Messages -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
			<?php
			if (isset($_SESSION['id'])) {
				$id = $_SESSION['id'];
				$userSql = mysqli_query($db, "SELECT * FROM `user` WHERE idLain = '$id'");
				
				if ($userSql) {
					while($profile = mysqli_fetch_array($userSql)) {
			?>
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $profile['username'] . " / " . $profile['idLain']; ?></span>
				<i class="fa fa-user text-primary"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
			<?php
					}
				}
			}
			?>
          </ul>
		  <!-- Logout Modal-->
		  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Keluar?</h5>
				  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
				</div>
				<div class="modal-body">Apakah benar ingin keluar?</div>
				<div class="modal-footer">
				  <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
				  <a class="btn btn-primary" href="logout.php">Keluar</a>
				</div>
			  </div>
			</div>
		  </div>