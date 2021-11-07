<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Edit Data Murid</title>
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
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" id="alert" style="display:none">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Data berhasil diubah!</strong> Silahkan cek pada menu View Data Murid.
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
									<h6 class="m-0 font-weight-bold text-primary">Edit Data Murid</h6>
								</div>
								<div class="card-body">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $dataMurid = mysqli_query($db, "SELECT * FROM `murid` WHERE idMurid = '$_GET[id]'");
                                        while ($data = mysqli_fetch_array($dataMurid)) {
                                    ?>
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Nama Murid:<br/>
												<input class="form-control col-8" type="text" name="namaMurid" value="<?= $data['namaMurid']; ?>" required/><br/>
												Nama Orang Tua:<br/>
												<input class="form-control col-8" type="text" name="namaOrtu" value="<?= $data['namaOrtu']; ?>" required/><br/>
												No. Handphone:<br/>
												<input class="form-control col-8" type="number" name="noHP" value="<?= $data['noHP']; ?>" required/><br/>
												Jenis Kelamin:<br/>
												<div class="form-check form-check-inline">
													<input type="radio" class="form-check-input" id="gender1" name="gender" value="Laki-Laki" <?= ($data['gender'] == "Laki-Laki") ? "checked" : ""; ?>/>
													<label class="form-check-label" for="gender1">
														Laki-Laki
													</label>
												</div>
												<div class="form-check form-check-inline">
													<input type="radio" class="form-check-input" id="gender2" name="gender" value="Perempuan" <?= ($data['gender'] == "Perempuan") ? "checked" : ""; ?>/>
													<label class="form-check-label" for="gender2">
														Perempuan
													</label>
												</div><br/><br/>
												Kelas:<br/>
												<input class="form-control col-8" type="text" name="kelas" value="<?= $data['kelas']; ?>" required/><br/>
												Tanggal Pendaftaran:<br/>
												<input class="form-control col-8" type="date" name="tglDaftar" value="<?= date('Y-m-d', strtotime($data['tglDaftar'])); ?>"/><br/>
												Jenis Paket:<br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="paket1" name="paket[]" value="Bimbel"/>
													<label class="form-check-label mr-2" for="paket1">Bimbel</label>
													<input class="form-check-input" type="checkbox" id="paket2" name="paket[]" value="Bahasa Mandarin"/>
													<label class="form-check-label" for="paket2">Bahasa Mandarin</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="paket3" name="paket[]" value="MAFIA"/>
													<label class="form-check-label mr-2" for="paket3">MAFIA</label>
													<input class="form-check-input" type="checkbox" id="paket4" name="paket[]" value="Bahasa Inggris"/>
													<label class="form-check-label" for="paket4">Bahasa Inggris</label>
												</div>
                                                <?php
                                                if (strpos($data['paket'], "Bimbel") !== false) {
													echo "<script>document.getElementById('paket1').checked='true';</script>";
												}
												if (strpos($data['paket'], "Bahasa Mandarin") !== false) {
													echo "<script>document.getElementById('paket2').checked='true';</script>";
												}
												if (strpos($data['paket'], "MAFIA") !== false) {
													echo "<script>document.getElementById('paket3').checked='true';</script>";
												}
												if (strpos($data['paket'], "Bahasa Inggris") !== false) {
													echo "<script>document.getElementById('paket4').checked='true';</script>";
                                                }
                                                ?>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:
												<select class="form-control  col-8" name="tingkatan">
													<option value="TK" <?= ($data['tingkat'] == "TK") ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= ($data['tingkat'] == "SD") ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= ($data['tingkat'] == "SMP") ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= ($data['tingkat'] == "SMA") ? "selected" : ""; ?>>SMA</option>
												</select>
											</div>
										</div>
										<script type="text/javascript">
										$(document).ready(function () {
											$('#checkBtn').click(function() {
											checked = $("input[type=checkbox]:checked").length;

											if(!checked) {
												alert("Pilih minimal 1 paket!");
												return false;
											}

											});
										});

										</script>
										<center>
											<input type="submit" class="btn btn-primary" name="tambah" id="checkBtn" value="Save"/>
										</center>
									</form>
									<?php
                                        }
                                    }
									if (isset($_POST['tambah']) && isset($_GET['id'])) {
										$namaMurid = $_POST['namaMurid'];
										$namaOrtu = $_POST['namaOrtu'];
										$noHP = $_POST['noHP'];
										$gender = $_POST['gender'];
										$kelas = $_POST['kelas'];
										$tglDaftar = date('Y-m-d', strtotime($_POST['tglDaftar']));
										$paket = implode(", " , $_POST['paket']);
										$tingkat = $_POST['tingkatan'];
                                        $idMurid = $_GET['id'];
                                        
										$inputData = mysqli_query($db, "UPDATE `murid` SET `idMurid`='$idMurid',`namaMurid`='$namaMurid',`namaOrtu`='$namaOrtu',`noHP`='$noHP',`gender`='$gender',`kelas`='$kelas',`tglDaftar`='$tglDaftar',`paket`='$paket',`tingkat`='$tingkat' WHERE idMurid = '$idMurid'");
										if ($inputData) {
											echo "<script>document.getElementById('alert').style.display='inline';</script>";
										}
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