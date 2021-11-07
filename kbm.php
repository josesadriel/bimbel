<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Tambah Jadwal KBM</title>
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
								<strong>Jadwal berhasil ditambahkan!</strong> Silahkan cek pada menu View Jadwal KBM.
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
									<h6 class="m-0 font-weight-bold text-primary">Tambah Jadwal KBM</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Kelas:<br/>
												<input type="text" class="form-control col-6" name="kelas" value="<?= (isset($_POST['kelas'])) ? $_POST['kelas'] : ""; ?>" required/><br/>
												Jenis Paket:<br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="paket1" name="paket" <?= (isset($_POST['paket']) && $_POST['paket'] == 'Bimbel') ? "checked" : ""; ?> value="Bimbel" required/>
													<label class="form-check-label mr-2" for="paket1">Bimbel</label>
													<input class="form-check-input" type="radio" id="paket2" name="paket" <?= (isset($_POST['paket'])) && $_POST['paket'] == 'Bahasa Mandarin' ? "checked" : ""; ?> value="Bahasa Mandarin"/>
													<label class="form-check-label" for="paket2">Bahasa Mandarin</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="paket3" name="paket" <?= (isset($_POST['paket']) && $_POST['paket'] == 'MAFIA') ? "checked" : ""; ?> value="MAFIA"/>
													<label class="form-check-label mr-2" for="paket3">MAFIA</label>
													<input class="form-check-input" type="radio" id="paket4" name="paket" <?= (isset($_POST['paket']) && $_POST['paket'] == 'Bahasa Inggris') ? "checked" : ""; ?> value="Bahasa Inggris"/>
													<label class="form-check-label" for="paket4">Bahasa Inggris</label><br/>
												</div><br/><br/>
												Jam:<br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="jam1" name="jam" value="10:00-12:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '10:00-12:00') ? "checked" : ""; ?> required/>
													<label class="form-check-label mr-4" for="jam1">10.00-12.00</label>
													<input class="form-check-input" type="radio" id="jam2" name="jam" value="13:00-20:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '13:00-20:00') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam2">13.00-20.00</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="jam3" name="jam" value="11:00-16:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '11:00-16:00') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam3">11.00-16.00</label>
													<input class="form-check-input" type="radio" id="jam4" name="jam" value="15:00-17:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '15:00-17:00') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam4">15.00-17.00</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="jam5" name="jam" value="11:30-14:30" <?= (isset($_POST['jam']) && $_POST['jam'] == '11:30-14:30') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam5">11.30-14.30</label>
													<input class="form-check-input" type="radio" id="jam6" name="jam" value="18:00-20:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '18:00-20:00') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam6">18.00-20.00</label>
												</div><br/>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" id="jam7" name="jam" value="13:00-18:00" <?= (isset($_POST['jam']) && $_POST['jam'] == '13:00-18:00') ? "checked" : ""; ?>/>
													<label class="form-check-label mr-4" for="jam7">13.00-18.00</label>
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
												</div><br/><br/>
												<?php
												if (isset($_POST['hari'])) {
													$sHari = $_POST['hari'];
													for ($i = 0; $i < count($sHari); $i++) {
														if ($sHari[$i] == "Monday") {
															echo "<script>document.getElementById('hari1').checked = 'true';</script>";
														}
														else if ($sHari[$i] == "Thursday") {
															echo "<script>document.getElementById('hari4').checked = 'true';</script>";
														}
														else if ($sHari[$i] == "Tuesday") {
															echo "<script>document.getElementById('hari2').checked = 'true';</script>";
														}
														else if ($sHari[$i] == "Friday") {
															echo "<script>document.getElementById('hari5').checked = 'true';</script>";
														}
														else if ($sHari[$i] == "Wednesday") {
															echo "<script>document.getElementById('hari3').checked = 'true';</script>";
														}
													}
												}
												?>
												<div style="display:none" id="listTentor">
													Tentor:<br/>
													<select name="tentor" class="form-control col-6">
														<?php
														$implodeHari = implode(", ", $_POST['hari']);
														$listTentor = mysqli_query($db, "SELECT * FROM `tentor` WHERE `kelas` LIKE '%$_POST[kelas]%' AND `paket` LIKE '%$_POST[paket]%' AND `tingkat` LIKE '%$_POST[tingkatan]%' AND `hariMengajar` LIKE '%$implodeHari%' AND `idTentor` NOT IN (SELECT tentor FROM `kbm` WHERE kbm.tentor = tentor.idTentor AND kbm.paket = '$_POST[paket]' AND kbm.tingkat = '$_POST[tingkatan]' AND kbm.kelas = '$_POST[kelas]')");
														if (mysqli_num_rows($listTentor) > 0) {
															while ($lTentor = mysqli_fetch_array($listTentor)) {
														?>
														<option value="<?php echo $lTentor['idTentor']; ?>"><?php echo $lTentor['namaTentor'] . " - " . $lTentor['idTentor']; ?></option>
														<?php
															}
														}
														else echo "<option value='' disabled selected>Kosong</option>";
														?>
													</select>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<select name="tingkatan" class="form-control col-6" required>
													<option value="" disabled <?= (isset($_POST['tingkatan'])) ? "" : "selected"; ?>>Pilih</option>
													<option value="TK" <?= (isset($_POST['tingkatan']) && $_POST['tingkatan'] == 'TK') ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= (isset($_POST['tingkatan']) && $_POST['tingkatan'] == 'SD') ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= (isset($_POST['tingkatan']) && $_POST['tingkatan'] == 'SMP') ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= (isset($_POST['tingkatan']) && $_POST['tingkatan'] == 'SMA') ? "selected" : ""; ?>>SMA</option>
												</select>
											</div>
										</div>
										<center id="tombol1">
											<script type="text/javascript">
											$(document).ready(function () {
												$('#checkBtn').click(function() {
												checked = $("input[type=checkbox]:checked").length;

												if(!checked) {
													alert("Pilih salah satu hari mengajar!");
													return false;
												}

												});
											});

											</script>
											<input type="submit" class="btn btn-primary" name="cari" value="Cari Tentor" id="checkBtn"/>
										</center>
										<center id="tombol2" style="display:none">
											<input type="submit" class="btn btn-primary" name="tambah" value="Save"/>
											<a href="" class="btn btn-danger">Reset</a>
										</center>
									</form>
									<?php
									if (isset($_POST['cari'])) {
										echo "<script>";
										echo "document.getElementById('listTentor').style.display='inline';";
										echo "document.getElementById('tombol1').style.display='none';";
										echo "document.getElementById('tombol2').style.display='block';";
										echo "</script>";
									}
									if (isset($_POST['tambah']) && isset($_POST['tentor'])) {
										$kelas = $_POST['kelas'];
										$paket = $_POST['paket'];
										$jam = explode("-", $_POST['jam']);
										$hari = implode(", ", $_POST['hari']);
										$tentor = $_POST['tentor'];
										$tingkat = $_POST['tingkatan'];
										if ($tentor != '') {
											$cekJadwal = mysqli_query($db, "SELECT * FROM `kbm` WHERE tentor = '$tentor' AND paket = '$paket' AND kelas = '$kelas'");
											if (mysqli_num_rows($cekJadwal) == 0) {
												$addJadwal = mysqli_query($db, "INSERT INTO `kbm` (kelas, paket, jamMulai, jamAkhir, hariMengajar, tentor, tingkat) VALUES ('$kelas', '$paket', '$jam[0]', '$jam[1]', '$hari', '$tentor', '$tingkat')");
												if ($addJadwal) {
													echo "<script>document.getElementById('alert').style.display='inline';</script>";
												}
											}
											else echo "<script>alert('Data KBM sudah ada'); </script>";
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