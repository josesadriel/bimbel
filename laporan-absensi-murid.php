<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Laporan Absensi Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Laporan Absensi Murid</h6>
								</div>
								<div class="card-body">
                                    <div class="d-flex justify-content-end">
                                        Bulan:
                                        <select name="bulan" class="form-control col-2 ml-2" onchange="getData('bulan', this.value)">
                                            <option value="" disabled selected>Pilih</option>
                                            <option value="01" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '01') ? "selected" : '' ?>>Januari</option>
                                            <option value="02" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '02') ? "selected" : '' ?>>Februari</option>
                                            <option value="03" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '03') ? "selected" : '' ?>>Maret</option>
                                            <option value="04" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '04') ? "selected" : '' ?>>April</option>
                                            <option value="05" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '05') ? "selected" : '' ?>>Mei</option>
                                            <option value="06" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '06') ? "selected" : '' ?>>Juni</option>
                                            <option value="07" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '07') ? "selected" : '' ?>>Juli</option>
                                            <option value="08" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '08') ? "selected" : '' ?>>Agustus</option>
                                            <option value="09" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '09') ? "selected" : '' ?>>September</option>
                                            <option value="10" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '10') ? "selected" : '' ?>>Oktober</option>
                                            <option value="11" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '11') ? "selected" : '' ?>>November</option>
                                            <option value="12" <?= (isset($_GET['bulan']) && $_GET['bulan'] == '12') ? "selected" : '' ?>>Desember</option>
                                        </select>
                                        <select name="tahun" class="form-control col-2 ml-2" onchange="getData('tahun', this.value)">
                                            <option value="" disabled selected>Pilih</option>
                                            <?php
                                            $listTahun = mysqli_query($db, "SELECT YEAR(tglAbsen) 'tahun' FROM `absensi_tentor` GROUP BY YEAR(tglAbsen) ORDER BY YEAR(tglAbsen) ASC");
                                            while ($tahun = mysqli_fetch_array($listTahun)) {
                                            ?>
                                            <option value="<?= $tahun['tahun']; ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $tahun['tahun']) ? "selected" : '' ?>><?= $tahun['tahun']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
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
									</div>
                                    <br/>
									<div class="table-responsive">
                                        <table id="dataTable" border="0" class="table table-bordered">
                                            <thead>
												<tr>
													<th>ID Murid</th>
													<th>Nama</th>
													<th>Paket</th>
													<th>Total Kehadiran</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $listAbsen = mysqli_query($db, "SELECT idMurid, namaMurid, paket, COUNT(*) as 'kehadiran' FROM `absensi_murid` WHERE absensi = 'Hadir' GROUP BY idMurid, paket");
                                                if (isset($_GET['bulan'])) $listAbsen = mysqli_query($db, "SELECT idMurid, namaMurid, paket, COUNT(*) as 'kehadiran' FROM `absensi_murid` WHERE absensi = 'Hadir' AND MONTH(tanggalAbsen) = '$_GET[bulan]' GROUP BY idMurid, paket");
                                                if (isset($_GET['bulan']) && isset($_GET['tahun'])) $listAbsen = mysqli_query($db, "SELECT idMurid, namaMurid, paket, COUNT(*) as 'kehadiran' FROM `absensi_murid` WHERE absensi = 'Hadir' AND MONTH(tanggalAbsen) = '$_GET[bulan]' AND YEAR(tanggalAbsen) = '$_GET[tahun]' GROUP BY idMurid, paket");
                                                
                                                if (mysqli_num_rows($listAbsen) > 0) {
                                                    while ($list = mysqli_fetch_array($listAbsen)) {
                                                ?>
                                                <tr>
                                                    <td><?= $list['idMurid']; ?></td>
                                                    <td><?= $list['namaMurid']; ?></td>
                                                    <td><?= $list['paket']; ?></td>
                                                    <td><?= $list['kehadiran']; ?></td>
                                                    <td><a href="daftar-absen-murid.php?id=<?= $list['idMurid'] . '&paket=' . $list['paket']; ?>">Lihat Absen</td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
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
	
	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>
	</body>
</html>