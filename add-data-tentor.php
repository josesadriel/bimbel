<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Tambah Tentor</title>
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
								<strong>Data berhasil ditambahkan!</strong> Silahkan cek pada menu View Data Tentor.
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
									<h6 class="m-0 font-weight-bold text-primary">Tambah Data Tentor</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Nama Tentor:<br/>
												<input class="form-control col-8" type="text" name="namaTentor" required/><br/>
												Pendidikan Terakhir:<br/>
												<input class="form-control col-8" type="text" name="pendidikan" required/><br/>
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
												<input class="form-control col-8" type="text" name="kelas" required/><br/>
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
												</div><br/><br/>
												Hari Mengajar:<br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="hari1" name="hari[]" value="Monday"/>
													<label class="form-check-label mr-2" for="hari1">Senin</label>
													<input class="form-check-input" type="checkbox" id="hari4" name="hari[]" value="Thursday"/>
													<label class="form-check-label mr-2" for="hari4">Kamis</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="hari2" name="hari[]" value="Tuesday"/>
													<label class="form-check-label mr-2" for="hari2">Selasa</label>
													<input class="form-check-input" type="checkbox" id="hari5" name="hari[]" value="Friday"/>
													<label class="form-check-label mr-2" for="hari5">Jumat</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="hari3" name="hari[]" value="Wednesday"/>
													<label class="form-check-label mr-2" for="hari3">Rabu</label>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="tingkat1" name="tingkatan[]" value="TK-SD"/>
													<label class="form-check-label mr-2" for="tingkat1">TK-SD</label><br/>
													<input class="form-check-input" type="checkbox" id="tingkat2" name="tingkatan[]" value="SMP"/>
													<label class="form-check-label mr-2" for="tingkat2">SMP</label><br/>
													<input class="form-check-input" type="checkbox" id="tingkat3" name="tingkatan[]" value="SMA"/>
													<label class="form-check-label mr-2" for="tingkat3">SMA</label><br/>
												</div><br/>
												Jenis Tentor:<br/>
												<div class="form-check">
													<input type="radio" class="form-check-input" id="jenis1" name="jenisTentor" value="Harian" required/>
													<label class="form-check-label mr-2" for="jenis1">Harian</label><br/>
													<input type="radio" class="form-check-input" id="jenis2" name="jenisTentor" value="Tetap"/>
													<label class="form-check-label mr-2" for="jenis2">Tetap</label><br/>
												</div><br/>
												Jam Mengajar:<br/>
												<div class="form-check">
													<input type="radio" class="form-check-input" id="jam1" name="jamMengajar" value="10.00-20.00" required/>
													<label class="form-check-label mr-2" for="jam1">10.00-20.00</label><br/>
													<input type="radio" class="form-check-input" id="jam2" name="jamMengajar" value="11.00-19.00"/>
													<label class="form-check-label mr-2" for="jam2">11.00-19.00</label><br/>
													<input type="radio" class="form-check-input" id="jam3" name="jamMengajar" value="14.00-20.00"/>
													<label class="form-check-label mr-2" for="jam3">14.00-20.00</label><br/>
												</div>
											</div>
										</div>
										<script type="text/javascript">
										$(document).ready(function () {
											$('#checkBtn').click(function() {
											paket = $("input[name='paket[]']").serializeArray();
											hari = $("input[name='hari[]']").serializeArray();
											tingkat = $("input[name='tingkatan[]']").serializeArray();
											if(paket.length === 0) {
												alert("Pilih minimal 1 paket!");
												return false;
											}
											if(hari.length === 0) {
												alert("Pilih minimal 1 hari!");
												return false;
											}
											if(tingkat.length === 0) {
												alert("Pilih minimal 1 tingkat!");
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
										$cekTentor = mysqli_query($db, "SELECT idTentor FROM `tentor` ORDER BY idTentor DESC LIMIT 1");
										$jumlahAkhir = 1;
										while ($cTentor = mysqli_fetch_array($cekTentor)) {
										    $cutString = substr($cTentor['idTentor'], 2);
										    $jumlahAkhir = $cutString + 1;
										}
										$idTentor = "TE" . str_pad($jumlahAkhir, 3, '0', STR_PAD_LEFT);
										$namaTentor = $_POST['namaTentor'];
										$pendidikan = $_POST['pendidikan'];
										$noHP = $_POST['noHP'];
										$gender = $_POST['gender'];
										$kelas = $_POST['kelas'];
										$tglDaftar = date("Y-m-d", strtotime($_POST['tglDaftar']));
										$paket = implode(", ", $_POST['paket']);
										$hari = implode(", ", $_POST['hari']);
										$tingkat = implode(", ", $_POST['tingkatan']);
										$jenisTentor = $_POST['jenisTentor'];
										$jamAjar = $_POST['jamMengajar'];
										
										$dataTentor = mysqli_query($db, "INSERT INTO `tentor` (idTentor, namaTentor, pendidikan, noHP, gender, kelas, tglDaftar, paket, hariMengajar, tingkat, jenisTentor, jamAjar) VALUES ('$idTentor', '$namaTentor', '$pendidikan', '$noHP', '$gender', '$kelas', '$tglDaftar', '$paket', '$hari', '$tingkat', '$jenisTentor', '$jamAjar')");
										if ($dataTentor) {
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