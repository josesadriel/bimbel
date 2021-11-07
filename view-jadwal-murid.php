<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>View Jadwal Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Jadwal Murid (<?php echo $_GET['id']; ?>)</h6>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table border="0">
											<?php
											$dataMurid = mysqli_query($db, "SELECT * FROM `murid` WHERE idMurid = '$_GET[id]'");
											while ($dMurid = mysqli_fetch_array($dataMurid)) {
												$paketMurid = str_replace(", ", "|", $dMurid['paket']);
												$kelasMurid = $dMurid['kelas'];
												$namaMurid = $dMurid['namaMurid'];
											?>
											<tr><td>ID Murid</td><td>: <?php echo $dMurid['idMurid']; ?></td></tr>
											<tr><td>Nama Murid</td><td>: <?php echo $dMurid['namaMurid']; ?></td></tr>
											<tr><td>Jenis Paket</td><td>: <?php echo $dMurid['paket']; ?></td></tr>
											<tr><td>Kelas</td><td>: <?php echo $dMurid['kelas']; ?></td></tr>
											<?php
											}
											?>
										</table>
										<br/>
									</div>
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID Murid</th>
													<th>Nama Murid</th>
													<th>Kelas</th>
													<th>Paket</th>
													<th>Hari</th>
													<th>Jam</th>
													<th>Tentor</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$dataJadwal = mysqli_query($db, "SELECT murid.idMurid, murid.namaMurid, murid.kelas, kbm.paket, kbm.hariMengajar, kbm.jamMulai, kbm.jamAkhir, tentor.namaTentor from kbm, murid, tentor where kbm.kelas = '$kelasMurid' AND kbm.paket REGEXP '$paketMurid' AND tentor.idTentor = kbm.tentor AND murid.namaMurid = '$namaMurid'");
												if (mysqli_num_rows($dataJadwal) > 0) {
													while ($dJadwal = mysqli_fetch_array($dataJadwal)) {
												?>
												<tr>
													<td><?php echo $dJadwal['idMurid'];?></td>
													<td><?php echo $dJadwal['namaMurid'];?></td>
													<td><?php echo $dJadwal['kelas'];?></td>
													<td><?php echo $dJadwal['paket'];?></td>
													<td><?php echo $dJadwal['hariMengajar'];?></td>
													<td><?php echo $dJadwal['jamMulai'] . "-" . $dJadwal['jamAkhir'];?></td>
													<td><?php echo $dJadwal['namaTentor'];?></td>
												</tr>
												<?php
													}
												}
												?>
											</tbody>
										</table>
									</div><br/>
									<div class="text-center">
										<a href="print.php?table=murid&id=<?= $_GET['id']; ?>" class="btn btn-success" target="_blank"> <i class="fa fa-print"></i> Print</a>
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