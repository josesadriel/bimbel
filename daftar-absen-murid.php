<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Daftar Absensi Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Daftar Absensi Murid</h6>
								</div>
								<div class="card-body">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $sql = "SELECT * FROM `murid` WHERE idMurid = '$_GET[id]'";
                                        
                                        $dataMurid = mysqli_query($db, $sql);
                                        while ($data = mysqli_fetch_array($dataMurid)) {
                                    ?>
                                    <div class="table-responsive">
                                        <table>
                                            <tr><td>ID Murid</td><td>: <?= $data['idMurid']; ?></td></tr>
                                            <tr><td>Nama Murid</td><td>: <?= $data['namaMurid']; ?></td></tr>
                                            <tr><td>Jenis Paket</td><td>: <?= $data['paket']; ?></td></tr>
                                            <tr><td>Kelas</td><td>: <?= $data['kelas']; ?></td></tr>
                                        </table>
                                    </div><br/>
                                    <?php
                                        }
                                    ?>
									<div class="table-responsive">
                                        <table id="dataTable" border="0" class="table table-bordered">
                                            <thead>
												<tr>
													<th>Tanggal Absen</th>
													<th>ID Murid</th>
													<th>Nama Murid</th>
													<th>Absen</th>
													<th>Keterangan</th>
                                                    <th>Petugas</th>
												</tr>
											</thead>
											<tbody>
                                                <?php
                                                $listAbsen = "";
                                                if (isset($_GET['id'])) $listAbsen = mysqli_query($db, "SELECT * FROM `absensi_murid` WHERE idMurid = '$_GET[id]' ORDER BY tanggalAbsen ASC;");
                                                if (isset($_GET['id']) && isset($_GET['paket'])) $listAbsen = mysqli_query($db, "SELECT * FROM `absensi_murid` WHERE idMurid = '$_GET[id]' AND paket = '$_GET[paket]' ORDER BY tanggalAbsen ASC;");
                                                if (mysqli_num_rows($listAbsen) > 0) {
                                                    while ($list = mysqli_fetch_array($listAbsen)) {
                                                ?>
                                                <tr>
                                                    <td><?= date("d F Y", strtotime($list['tanggalAbsen'])); ?></td>
                                                    <td><?= $list['idMurid']; ?></td>
                                                    <td><?= $list['namaMurid']; ?></td>
                                                    <td><?= $list['absensi']; ?></td>
                                                    <td><?= $list['keterangan']; ?></td>
                                                    <td><?= $list['petugas']; ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
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
	
	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>
	</body>
</html>