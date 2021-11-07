<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Pembayaran Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Pembayaran Murid</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tanggal Pembayaran:<br/>
												<input class="form-control col-8" type="date" name="tglBayar" value="<?php echo date('Y-m-d'); ?>"/><br/>
												ID Murid:<br/>
												<select id="listDataMurid" name="idMurid" class="form-control col-6" onchange="getData('id', this.value)" required>
													<option value="" disabled selected>Pilih</option>
													<?php
													if (isset($_GET['tingkatan']) && $_GET['tingkatan'] != '') {
														$listDataMurid = mysqli_query($db, "SELECT * FROM `murid` WHERE tingkat = '$_GET[tingkatan]'");
													}
													else $listDataMurid = mysqli_query($db, "SELECT * FROM `murid`");
													while ($lDataMurid = mysqli_fetch_array($listDataMurid)) {
													?>
													<option value="<?= $lDataMurid['idMurid']; ?>" <?= (isset($_GET['id']) && $_GET['id'] == $lDataMurid['idMurid']) ? "selected" : ""; ?>><?= $lDataMurid['namaMurid'] . " - " . $lDataMurid['idMurid']; ?></option>
													<?php
													}
													?>
												</select><br/>
												Total yang dibayar:<br/>
												<?php
												if (isset($_GET['id'])) {
													$paket = "";
													$getPaket = mysqli_query($db, "SELECT * FROM `murid` WHERE idMurid = '$_GET[id]'");
													while ($paketMurid = mysqli_fetch_array($getPaket)) {
														$paket = explode(", ", $paketMurid['paket']);
													}
													$paket = implode("|", $paket);
													$total = 0;
													$getTotal = mysqli_query($db, "SELECT biaya_bimbingan.*, murid.idMurid, murid.namaMurid, murid.paket as 'paketMurid' FROM `biaya_bimbingan`, `murid` WHERE biaya_bimbingan.paket REGEXP '$paket' AND biaya_bimbingan.tingkat = murid.tingkat AND idMurid = '$_GET[id]'");
													while ($biaya = mysqli_fetch_array($getTotal)) {
														$total += $biaya['biaya'];
													}
												}
												?>
													<input type="number" name="totalBayar" id="totalBayar" class="form-control col-6" value="<?= $total; ?>" readonly/><br/>
												Bulan:<br/>
												<select name="bulan" class="form-control col-6">
													<option value="Januari">Januari</option>
													<option value="Februari">Februari</option>
													<option value="Maret">Maret</option>
													<option value="April">April</option>
													<option value="Mei">Mei</option>
													<option value="Juni">Juni</option>
													<option value="Juli">Juli</option>
													<option value="Agustus">Agustus</option>
													<option value="September">September</option>
													<option value="Oktober">Oktober</option>
													<option value="November">November</option>
													<option value="Desember">Desember</option>
												</select><br/>
												Pembayaran:
												<div class="form-check form-check-inline">
													<input type="radio" id="cash" name="metodePembayaran" value="Cash" class="form-check-input" required/>
													<label for="cash" class="form-check-label">Cash</label>
													<input type="radio" id="rekeningBCA" name="metodePembayaran" value="Rekening BCA" class="form-check-input ml-2"/>
													<label for="rekeningBCA" class="form-check-label">Rekening BCA</label>
													<input type="radio" id="ovo" name="metodePembayaran" value="OVO" class="form-check-input ml-2"/>
													<label for="ovo" class="form-check-label">OVO</label>
													<input type="radio" id="dana" name="metodePembayaran" value="DANA" class="form-check-input ml-2"/>
													<label for="dana" class="form-check-label">DANA</label>
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<select class="form-control  col-6" name="tingkatan" onchange="gantiTingkat('tingkatan', this.value)">
													<option value="TK" <?= (isset($_GET['tingkatan']) && $_GET['tingkatan'] == 'TK') ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= (isset($_GET['tingkatan']) && $_GET['tingkatan'] == 'SD') ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= (isset($_GET['tingkatan']) && $_GET['tingkatan'] == 'SMP') ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= (isset($_GET['tingkatan']) && $_GET['tingkatan'] == 'SMA') ? "selected" : ""; ?>>SMA</option>
												</select>
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
									function gantiTingkat(parameter, value) {
										window.location = "pembayaran-murid.php?tingkatan=" + value;
									}
									</script>
									<?php
									if (isset($_POST['bayar'])) {
										$tglBayar = date("Y-m-d", strtotime($_POST['tglBayar']));
										$idMurid = $_POST['idMurid'];
										$totalBayar = $_POST['totalBayar'];
										$bulan = $_POST['bulan'];
										$metode = $_POST['metodePembayaran'];
										$tingkatan = $_POST['tingkatan'];

										$cekData = mysqli_query($db, "SELECT pembayaranmurid.*, murid.namaMurid FROM `pembayaranmurid`, `murid` WHERE pembayaranmurid.idMurid = murid.idMurid AND pembayaranmurid.idMurid = '$idMurid' AND pembayaranmurid.bulan = '$bulan'");
										if (mysqli_num_rows($cekData) > 0) {
											echo "<script>alert('Data sudah ada!');</script>";
										}
										else {
											$inputPembayaranMurid = mysqli_query($db, "INSERT INTO `pembayaranmurid` (idMurid, tglBayar, bulan, total, metodePembayaran, tingkatan) VALUES ('$idMurid', '$tglBayar', '$bulan', '$totalBayar', '$metode', '$tingkatan')");
											if ($inputPembayaranMurid) {
												echo "<script>document.getElementById('alert').style.display='inline';</script>";
											}
										}
									}
									?>
								</div>
							</div>
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">List Pembayaran Murid</h6>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered">
											<tr>
												<th>Nama Murid</th>
												<th>Tanggal Pembayaran</th>
												<th>Bulan</th>
												<th>Total</th>
												<th>Keterangan</th>
											</tr>
											<?php
											$listPembayaran = mysqli_query($db, "SELECT pembayaranmurid.*, murid.namaMurid FROM `pembayaranmurid`, `murid` WHERE pembayaranmurid.idMurid = murid.idMurid");
											if (mysqli_num_rows($listPembayaran) > 0) {
												while ($lBayar = mysqli_fetch_array($listPembayaran)) {
											?>
											<tr>
												<td><?= $lBayar['namaMurid']; ?></td>
												<td><?= date("d F Y", strtotime($lBayar['tglBayar'])) ?></td>
												<td><?= $lBayar['bulan']; ?></td>
												<td>Rp. <?= $lBayar['total']; ?></td>
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