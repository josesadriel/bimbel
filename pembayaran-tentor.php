<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Pembayaran Tentor</title>
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
								<strong>Data berhasil ditambahkan!</strong>
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
									<h6 class="m-0 font-weight-bold text-primary">Pembayaran Tentor</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tanggal Pembayaran:<br/>
												<input class="form-control col-8" type="date" name="tglBayar" value="<?php echo date('Y-m-d'); ?>" required/><br/>
												ID Tentor:<br/>
												<select id="listDataTentor" name="idTentor" class="form-control col-6" onchange="getData('id', this.value)" required>
													<option value="" disabled selected>Pilih</option>
													<?php
													$listDataTentor = mysqli_query($db, "SELECT * FROM `tentor`");
													while ($lDataTentor = mysqli_fetch_array($listDataTentor)) {
													?>
													<option value="<?= $lDataTentor['idTentor']; ?>" <?= (isset($_GET['id']) && $_GET['id'] == $lDataTentor['idTentor']) ? "selected" : ""; ?>><?= $lDataTentor['namaTentor'] . " - " . $lDataTentor['idTentor']; ?></option>
													<?php
													}
													?>
												</select>
												<br/>
												<?php
												
												?>
												Bulan:<br/>
												<select name="bulan" class="form-control col-6" onchange="getData('bulan', this.value)" required>
													<option value="" <?= (!isset($_GET['bulan']) || $_GET['bulan'] == '') ? "selected" : ""; ?> disabled>Pilih</option>
													<option value="Januari" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Januari') ? "selected" : '' ?>>Januari</option>
													<option value="Februari" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Februari') ? "selected" : '' ?>>Februari</option>
													<option value="Maret" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Maret') ? "selected" : '' ?>>Maret</option>
													<option value="April" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'April') ? "selected" : '' ?>>April</option>
													<option value="Mei" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Mei') ? "selected" : '' ?>>Mei</option>
													<option value="Juni" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Juni') ? "selected" : '' ?>>Juni</option>
													<option value="Juli" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Juli') ? "selected" : '' ?>>Juli</option>
													<option value="Agustus" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Agustus') ? "selected" : '' ?>>Agustus</option>
													<option value="September" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'September') ? "selected" : '' ?>>September</option>
													<option value="Oktober" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Oktober') ? "selected" : '' ?>>Oktober</option>
													<option value="November" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'November') ? "selected" : '' ?>>November</option>
													<option value="Desember" <?= (isset($_GET['bulan']) && $_GET['bulan'] == 'Desember') ? "selected" : '' ?>>Desember</option>
												</select><br/>
												<?php
												if (isset($_GET['id']) && isset($_GET['bulan']) && $_GET['bulan'] != '') {
													$total = 0;
													$hadir = 0;
													$jTentor = '';
													$tTentor = '';
													$dataTentor = mysqli_query($db, "SELECT * FROM `tentor` WHERE idTentor = '$_GET[id]'");
													while ($jenisTentor = mysqli_fetch_array($dataTentor)) {
														$jTentor = $jenisTentor['jenisTentor'];
														$explodeArr = explode(", ",$jenisTentor['tingkat']);
														for ($i = 0; $i < count($explodeArr); $i++) {
															if ($explodeArr[$i] == 'TK-SD') {
																$explodeArr[$i] = 'TK';
																$explodeArr[count($explodeArr)] = 'SD'; 
															}
														}
														$tTentor = implode("|", $explodeArr);
													}
													$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
													$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
													$sBulan = str_ireplace($bulan, $month, $_GET['bulan']);
													$getData = mysqli_query($db, "SELECT absensi_tentor.idTentor, absensi_tentor.paket, honor_tentor.honor, tentor.jenisTentor, COUNT(absensi_tentor.idTentor) AS 'kehadiran', (honor_tentor.honor * COUNT(absensi_tentor.idTentor)) AS 'total' FROM `absensi_tentor`, `honor_tentor`, `tentor` WHERE absensi_tentor.idTentor = tentor.idTentor AND tentor.jenisTentor = honor_tentor.jenisTentor AND absensi_tentor.paket = honor_tentor.paket AND absensi_tentor.idTentor = '$_GET[id]' AND MONTHNAME(absensi_tentor.tglAbsen) = '$sBulan' AND absensi_tentor.absensi = 'Hadir' AND honor_tentor.tingkatan REGEXP '$tTentor' GROUP BY absensi_tentor.paket");
													while ($data = mysqli_fetch_array($getData)) {
														$total += $data['total'];
														$hadir += $data['kehadiran'];
													}

												?>
												Total Hadir:<br/>
												<input type="text" class="form-control col-6" name="kehadiran" value="<?= $hadir . 'x hadir'; ?>" readonly/><br/>
												
												Total yang dibayar:<br/>
												<input type="number" name="totalBayar" class="form-control col-6" value="<?= $total; ?>" required readonly/><br/>
												<?php
												}
												?>
												Pembayaran:
												<div class="form-check form-check-inline">
													<input type="radio" id="cash" name="metodePembayaran" value="Cash" class="form-check-input" required/>
													<label for="cash" class="form-check-label">Cash</label>
													<input type="radio" id="rekeningBCA" name="metodePembayaran" value="Rekening BCA" class="form-check-input ml-2"/>
													<label for="rekeningBCA" class="form-check-label">Rekening BCA</label>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<select class="form-control col-6" id="tingkatan" name="tingkatan">
													<option value="TK">TK</option>
													<option value="SD">SD</option>
													<option value="SMP">SMP</option>
													<option value="SMA">SMA</option>
												</select><br/>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" name="bayar" value="Bayar"/>
										</center>
									</form>
									<script>
									function getData(parameter, value) {
										var url = new URL(window.location.href);
										var search_params = url.searchParams;

										// add "topic" parameter
										search_params.set(parameter, value);

										url.search = search_params.toString();

										var new_url = url.toString();
										window.location = new_url;
									}
									</script>
									<?php
									if (isset($_POST['bayar'])) {
										$tglBayar = date("Y-m-d", strtotime($_POST['tglBayar']));
										$idTentor = $_POST['idTentor'];
										$totalBayar = $_POST['totalBayar'];
										$kehadiran = $_POST['kehadiran'];
										$bulan = $_POST['bulan'];
										$metode = $_POST['metodePembayaran'];
										$tingkatan = $_POST['tingkatan'];
										
										$inputPembayaranTentor = mysqli_query($db, "INSERT INTO `pembayarantentor` (idTentor, tglBayar, bulan, total, kehadiran, metodePembayaran, tingkatan) VALUES ('$idTentor', '$tglBayar', '$bulan', '$totalBayar', '$kehadiran', '$metode', '$tingkatan')");
										if ($inputPembayaranTentor) {
											echo "<script>document.getElementById('alert').style.display='inline';</script>";
										}
									}
									?>
								</div>
							</div>
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">List Pembayaran Tentor</h6>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<th>Tanggal Pembayaran</th>
												<th>Nama Tentor</th>
												<th>Bulan</th>
												<th>Keterangan</th>
												<th>Total</th>
												<th>Metode Pembayaran</th>
											</tr>
											<?php
											$listPembayaran = mysqli_query($db, "SELECT pembayarantentor.*, tentor.namaTentor FROM `pembayarantentor`, `tentor` WHERE tentor.idTentor = pembayarantentor.idTentor");
											if (mysqli_num_rows($listPembayaran) > 0) {
												while ($lBayar = mysqli_fetch_array($listPembayaran)) {
											?>
											<tr>
												<td><?= date("d F Y", strtotime($lBayar['tglBayar'])) ?></td>
												<td><?= $lBayar['namaTentor']; ?></td>
												<td><?= $lBayar['bulan']; ?></td>
												<td><?= $lBayar['kehadiran']; ?></td>
												<td>Rp. <?= number_format($lBayar['total'],0,',','.'); ?></td>
												<td><?= $lBayar['metodePembayaran']; ?></td>
											</tr>
											<?php
												}
											}
											?>
										</table>
									</div>
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