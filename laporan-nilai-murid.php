<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Daftar Nilai Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Daftar Nilai Murid</h6>
								</div>
								<div class="card-body">
									<div class="form-row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
											<div class="d-flex justify-content">
												ID Murid: 
												<select name="idMurid" class="ml-3 form-control col-6" onchange="getData('id', this.value)">
													<option value="" disabled selected>Pilih</option>
													<?php
													$murid = mysqli_query($db, "SELECT * FROM `murid`");
													if (isset($_GET['tingkat'])) $murid = mysqli_query($db, "SELECT * FROM `murid` WHERE tingkat = '$_GET[tingkat]'");
													while ($itemMurid = mysqli_fetch_array($murid)) {
													?>
													<option value="<?= $itemMurid['idMurid']; ?>" <?= (isset($_GET['id']) && $_GET['id'] == $itemMurid['idMurid']) ? "selected" : ""; ?>><?= $itemMurid['idMurid'] . "-" . $itemMurid['namaMurid']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
											<div class="d-flex justify-content-end">
												Tingkatan: 
												<select name="tingkat" class="ml-3 form-control col-4" onchange="getData('tingkat', this.value)">
													<option value="" disabled selected>Pilih</option>
													<option value="TK" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "TK") ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SD") ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SMP") ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SMA") ? "selected" : ""; ?>>SMA</option>
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
									</div><br/>
									<?php 
									$maxJumlah = 0;
									$maksUH = mysqli_query($db, "SELECT idMurid, namaMurid, mapel, MAX(CASE WHEN jenis = 'UH' THEN nilai ELSE '-' END) AS UH, MAX(CASE WHEN jenis = 'UTS' THEN nilai ELSE '-' END) AS UTS, MAX(CASE WHEN jenis = 'UAS' THEN nilai ELSE '-' END) AS UAS FROM `nilai_murid` GROUP BY idMurid, mapel");
									if (isset($_GET['id'])) $maksUH = mysqli_query($db, "SELECT idMurid, namaMurid, mapel, MAX(CASE WHEN jenis = 'UH' THEN nilai ELSE '-' END) AS UH, MAX(CASE WHEN jenis = 'UTS' THEN nilai ELSE '-' END) AS UTS, MAX(CASE WHEN jenis = 'UAS' THEN nilai ELSE '-' END) AS UAS FROM `nilai_murid` WHERE idMurid = '$_GET[id]' GROUP BY idMurid, mapel");
									
									while ($list = mysqli_fetch_array($maksUH)) {
                                        $uh = explode("|", $list['UH']);
										if (count($uh) > $maxJumlah) {
											$maxJumlah = count($uh); // untuk tugas harian ke-x
										}
									}
                                    ?>
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID Murid</th>
													<th>Nama Murid</th>
													<th>Mata Pelajaran</th>
													<?php
													for ($i = 0; $i < $maxJumlah; $i++) {
													?>
													<th>UH<?= $i+1; ?></th>
                                                    <?php
													}
													?>
													<th>UTS</th>
                                                    <th>UAS</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$listDataNilai = mysqli_query($db, "SELECT idMurid, namaMurid, mapel, MAX(CASE WHEN jenis = 'UH' THEN nilai ELSE '-' END) AS UH, MAX(CASE WHEN jenis = 'UTS' THEN nilai ELSE '-' END) AS UTS, MAX(CASE WHEN jenis = 'UAS' THEN nilai ELSE '-' END) AS UAS FROM `nilai_murid` GROUP BY idMurid, mapel");
												if (isset($_GET['id'])) $listDataNilai = mysqli_query($db, "SELECT idMurid, namaMurid, mapel, MAX(CASE WHEN jenis = 'UH' THEN nilai ELSE '-' END) AS UH, MAX(CASE WHEN jenis = 'UTS' THEN nilai ELSE '-' END) AS UTS, MAX(CASE WHEN jenis = 'UAS' THEN nilai ELSE '-' END) AS UAS FROM `nilai_murid` WHERE idMurid = '$_GET[id]' GROUP BY idMurid, mapel");
												if (isset($_GET['tingkat'])) $listDataNilai = mysqli_query($db, "SELECT nilai_murid.idMurid, nilai_murid.namaMurid, nilai_murid.mapel, MAX(CASE WHEN nilai_murid.jenis = 'UH' THEN nilai_murid.nilai ELSE '-' END) AS UH, MAX(CASE WHEN nilai_murid.jenis = 'UTS' THEN nilai_murid.nilai ELSE '-' END) AS UTS, MAX(CASE WHEN nilai_murid.jenis = 'UAS' THEN nilai_murid.nilai ELSE '-' END) AS UAS FROM `nilai_murid`, `murid` WHERE murid.idMurid = nilai_murid.idMurid AND murid.tingkat = '$_GET[tingkat]' GROUP BY idMurid, mapel");
												
												if (mysqli_num_rows($listDataNilai) > 0 ) {
													while($data = mysqli_fetch_array($listDataNilai)) {
												?>
												<tr>
													<td><?= $data['idMurid']; ?></a></td>
													<td><?= $data['namaMurid']; ?></td>
													<td><?= $data['mapel']; ?></td>
													<?php
													$nilaiUh = explode("|", $data['UH']);
													for ($i = 0; $i < $maxJumlah; $i++) {
														if (isset($nilaiUh[$i])) {
															echo '<td>' . $nilaiUh[$i] . '</td>';
														}
														else echo '<td>-</td>';
													}
													?>
                                                    <td><?= $data['UTS']; ?></td>
                                                    <td><?= $data['UAS']; ?></td>
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