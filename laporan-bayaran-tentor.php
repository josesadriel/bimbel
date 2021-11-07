<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Laporan Pembayaran Tentor</title>
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
		<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        
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
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Laporan Pembayaran Tentor</h6>
								</div>
								<div class="card-body">
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
											<div class="d-flex justify-content">
												Bulan:
												<select name="bulan" class="form-control col-5 ml-2" onchange="getData('bulan', this.value)">
													<option value="" disabled selected>Pilih</option>
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
												</select>
												<select name="tahun" class="form-control col-3 ml-2" onchange="getData('tahun', this.value)">
													<option value="" disabled selected>Pilih</option>
													<?php
													$listTahun = mysqli_query($db, "SELECT YEAR(tglBayar) 'tahun' FROM `pembayarantentor` GROUP BY YEAR(tglBayar) ORDER BY YEAR(tglBayar) ASC");
													while ($tahun = mysqli_fetch_array($listTahun)) {
													?>
													<option value="<?= $tahun['tahun']; ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $tahun['tahun']) ? "selected" : '' ?>><?= $tahun['tahun']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
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
										<br/><br/>
										<div class="table-responsive">
											<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>Nama Tentor</th>
														<th>Jenis</th>
														<th>Jumlah</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$listDataBayaran = mysqli_query($db, "SELECT tentor.namaTentor, pembayarantentor.metodePembayaran, pembayarantentor.total FROM `pembayarantentor`, `tentor` WHERE pembayarantentor.idTentor = tentor.idTentor");
													if (isset($_GET['bulan'])) $listDataBayaran = mysqli_query($db, "SELECT tentor.namaTentor, pembayarantentor.metodePembayaran, pembayarantentor.total FROM `pembayarantentor`, `tentor` WHERE pembayarantentor.idTentor = tentor.idTentor AND pembayarantentor.bulan = '$_GET[bulan]'");
													if (isset($_GET['bulan']) && isset($_GET['tahun'])) $listDataBayaran = mysqli_query($db, "SELECT tentor.namaTentor, pembayarantentor.metodePembayaran, pembayarantentor.total FROM `pembayarantentor`, `tentor` WHERE pembayarantentor.idTentor = tentor.idTentor AND pembayarantentor.bulan = '$_GET[bulan]' AND YEAR(pembayarantentor.tglBayar) = '$_GET[tahun]'");
													$total = 0;
													if (mysqli_num_rows($listDataBayaran) > 0 ) {
														while($data = mysqli_fetch_array($listDataBayaran)) {
														    $total += $data['total'];
													?>
													<tr>
														<td><?= $data['namaTentor']; ?></a></td>
														<td><?= $data['metodePembayaran']; ?></td>
														<td>Rp. <?= number_format($data['total'],2,',','.'); ?></td>
													</tr>
													<?php
														}
													}
													?>
												</tbody>
											</table>
											<div class="text-right"><b>Total</b>: Rp. <?= number_format($total,2,',','.'); ?></div>
										</div>
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
	
	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>
	</body>
</html>