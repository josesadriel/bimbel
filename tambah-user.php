<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Tambah User</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
        
    </head>
    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php include("topBar.php"); ?>
                </nav>
                <div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" id="alertSukses" style="display:none">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>User berhasil ditambahkan!</strong> Silahkan cek pada menu Daftar User.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<?php
						if (isset($_GET['alert']) && $_GET['alert'] == 'sukses') echo "<script>document.getElementById('alertSukses').style.display='inline';</script>";
						?>
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" id="alertError1" style="display:none">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Terjadi kesalahan!</strong> Silahkan cek pada bagian password.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" id="alertError2" style="display:none">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Terjadi kesalahan!</strong> Silahkan pilih role.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
                    <div class="row">
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Role:<br/>
												<div class="form-check">
													<input class="form-check-input" type="radio" id="role1" name="role" value="Administrasi" required/>
													<label class="form-check-label" for="role1">Administrasi</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" id="role2" name="role" value="Akademik"/>
													<label class="form-check-label" for="role2">Akademik</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" id="role3" name="role" value="User"/>
													<label class="form-check-label" for="role3">User</label>
												</div>
												<br/>
												<?php
												if (isset($_GET['role'])) {
													$role = $_GET['role'];
													if ($role == "Administrasi") {
														echo "<script>document.getElementById('role1').checked = 'true';</script>";
													}
													else if ($role == "Akademik") {
														echo "<script>document.getElementById('role2').checked = 'true';</script>";
													}
													else if ($role == "User") {
														echo "<script>document.getElementById('role3').checked = 'true';</script>";
													}
												}
												?>
												Username:<br/>
												<input type="text" id="username" name="username" class="form-control col-6" value="<?= $_GET['username'] ?? "";?>" required/><br/>
												Password:<br/>
												<input type="password" id="password" name="password" class="form-control col-6" value="<?= $_GET['password'] ?? "";?>" required/><br/>
												Konfirmasi Password:<br/>
												<input type="password" id="k_pass" name="k_password" class="form-control col-6" value="<?= $_GET['k_pass'] ?? "";?>" required/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis:<br/>
												<select name="jenis" id="jenis" class="form-control col-6" onchange="show()" required>
													<option id="kosong" value="" disabled selected>Pilih</option>
													<option id="Tentor" value="Tentor">Tentor</option>
													<option id="Murid" value="Murid">Murid</option>
												</select><br/>
												<div id="fieldData" style="display:none">
													Kaitkan dengan data:<br/>
													<select id="listData" name="idLain" class="form-control col-6" required>
														<option value="" disabled selected>Pilih</option>
														<?php
														if (isset($_GET['jenis'])) {
															if ($_GET['jenis'] == "Tentor") {
																$listDataTentor = mysqli_query($db, "SELECT * FROM `tentor` WHERE idTentor NOT IN (SELECT idLain FROM `user`)");
																while ($lDataTentor = mysqli_fetch_array($listDataTentor)) {
														?>
														<option value="<?= $lDataTentor['idTentor']; ?>"><?= $lDataTentor['namaTentor'] . " - " . $lDataTentor['idTentor']; ?></option>
														<?php
																}
															}
															else if ($_GET['jenis'] == "Murid") {
																$listDataMurid = mysqli_query($db, "SELECT * FROM `murid` WHERE idMurid NOT IN (SELECT idLain FROM `user`)");
																while ($lDataMurid = mysqli_fetch_array($listDataMurid)) {
														?>
														<option value="<?= $lDataMurid['idMurid']; ?>"><?= $lDataMurid['namaMurid'] . " - " . $lDataMurid['idMurid']; ?></option>
														<?php
																}
															}
														}
														?>
													</select><br/>
												</div>
												<?php
												if (isset($_GET['jenis'])) {
													if ($_GET['jenis'] == "Tentor") {
														echo "<script>";
														echo "document.getElementById('kosong').selected = false;";
														echo "document.getElementById('Tentor').selected = true;";
														echo "document.getElementById('fieldData').style.display='inline';";
														echo "</script>";
													}
													else if ($_GET['jenis'] == "Murid") {
														echo "<script>";
														echo "document.getElementById('kosong').selected = false;";
														echo "document.getElementById('Murid').selected = true;";
														echo "document.getElementById('fieldData').style.display='inline';";
														echo "</script>";
													}
												}
												?>
												<script>
												function show() {
													var username = document.getElementById('username').value;
													var password = document.getElementById('password').value;
													var kPass = document.getElementById('k_pass').value;
													var jenis = document.getElementById('jenis').value;
													var checkboxes = document.getElementsByName('role');
													var val = "";
													for (i = 0; i < checkboxes.length; i++) {
														if (checkboxes[i].checked) {
															val = checkboxes[i].value;
														}
													}
													window.location = "tambah-user.php" + "?jenis=" + jenis + "&username=" + username + "&password=" + password + "&k_pass=" + kPass + "&role=" + val;
												}
												</script>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" id="tambah" name="tambah" value="Save"/>
											<input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
										</center>
									</form>
									<?php
									if (isset($_POST['tambah'])) {
										$role = $_POST['role'];
										$username = $_POST['username'];
										$password = $_POST['password'];
										$kPassword = $_POST['k_password'];
										$jenis = $_POST['jenis'];
										$idLain = $_POST['idLain'];
										$cekJenis = mysqli_query($db, "SELECT idUser FROM `user` WHERE jenis = '$jenis' ORDER BY idUser DESC LIMIT 1");
										$jumlahAkhir = 1; //nomor pendaftar akhir dari jenis yang dipilih
										while ($cJenis = mysqli_fetch_array($cekJenis)) {
											$cutString = substr($cJenis['idUser'],2);
											$jumlahAkhir = $cutString + 1;
										}
										$idUser = strtoupper(substr($_POST['jenis'], 0, 2)) . str_pad($jumlahAkhir, 3, '0', STR_PAD_LEFT);
										if ($role == "" || $role == null) {
											echo "<script>document.getElementById('alertError2').style.display='inline';</script>";
										}
										if ($password == $kPassword) {
											$inputData = mysqli_query($db, "INSERT INTO `user` (idUser, username, password, role, jenis, idLain) VALUES ('$idUser', '$username', '$password', '$role', '$jenis', '$idLain')");
											if ($inputData) {
												echo "<meta http-equiv='refresh' content='0; url=tambah-user.php?alert=sukses'>";
											}
										}
										else echo "<script>document.getElementById('alertError1').style.display='inline';</script>";
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Ayen Medan 2020</span>
					</div>
				</div>
			</footer>
		</div>
	</div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>