<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Add Data Murid</title>
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
								<strong>Data berhasil ditambahkan!</strong> Silahkan cek pada menu View Data Murid.
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
									<h6 class="m-0 font-weight-bold text-primary">Tambah Data Murid</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Nama Murid:<br/>
												<input class="form-control col-8" type="text" name="namaMurid" required/><br/>
												Nama Orang Tua:<br/>
												<input class="form-control col-8" type="text" name="namaOrtu" required/><br/>
												No. Handphone:<br/>
												<input class="form-control col-8" type="number" name="noHP" required/><br/>
												Jenis Kelamin:<br/>
												<div class="form-check form-check-inline">
													<input type="radio" class="form-check-input" id="gender1" name="gender" value="Laki-Laki" checked required/>
													<label class="form-check-label" for="gender1">
														Laki-Laki
													</label>
												</div>
												<div class="form-check form-check-inline">
													<input type="radio" class="form-check-input" id="gender2" name="gender" value="Perempuan" />
													<label class="form-check-label" for="gender2">
														Perempuan
													</label>
												</div><br/><br/>
												Kelas:<br/>
												<input class="form-control col-8" type="text" name="kelas" max="12" required/><br/>
												Tanggal Pendaftaran:<br/>
												<input class="form-control col-8" type="date" name="tglDaftar" value="<?php echo date('Y-m-d'); ?>"/><br/>
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
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:
												<select class="form-control  col-8" name="tingkatan">
													<option value="TK">TK</option>
													<option value="SD">SD</option>
													<option value="SMP">SMP</option>
													<option value="SMA">SMA</option>
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
											<input type="submit" class="btn btn-primary" id="checkBtn" name="tambah" value="Save"/>
											<input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
										</center>
									</form>
									<?php
									if (isset($_POST['tambah'])) {
										$namaMurid = $_POST['namaMurid'];
										$namaOrtu = $_POST['namaOrtu'];
										$noHP = $_POST['noHP'];
										$gender = $_POST['gender'];
										$kelas = $_POST['kelas'];
										$tglDaftar = date('Y-m-d', strtotime($_POST['tglDaftar']));
										$paket = implode(", " , $_POST['paket']);
										$tingkat = $_POST['tingkatan'];
										$idMurid = "";
										if ($tingkat == "SMP") {
											$idMurid = strtoupper(substr($tingkat, 1, 2));
										}
										else $idMurid = strtoupper(substr($tingkat, 0, 2));
										$cekTingkat = mysqli_query($db, "SELECT idMurid FROM `murid` WHERE tingkat = '$tingkat' ORDER BY idMurid DESC LIMIT 1");
										$jumlahAkhir = 1; //nomor pendaftar akhir dari jenis yang dipilih
										while ($cTingkat = mysqli_fetch_array($cekTingkat)) {
											$cutString = substr($cTingkat['idMurid'],-3);
											$jumlahAkhir = $cutString + 1;
										}
										$idMurid .= $kelas . str_pad($jumlahAkhir, 3, '0', STR_PAD_LEFT);
										$inputData = mysqli_query($db, "INSERT INTO `murid` (idMurid, namaMurid, namaOrtu, noHP, gender, kelas, tglDaftar, paket, tingkat) VALUES ('$idMurid', '$namaMurid', '$namaOrtu', '$noHP', '$gender', '$kelas', '$tglDaftar', '$paket', '$tingkat')");
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