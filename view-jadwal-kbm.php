<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>View Jadwal KBM</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Jadwal KBM</h6>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-end">
										Jenis Paket:
										<select name="paket" id="pilihPaket" class="form-control col-3" onchange="refresh()">
											<option value="" disabled selected>Pilih</option>
											<option value="Bimbel">Bimbel</option>
											<option value="MAFIA">MAFIA</option>
											<option value="Bahasa Mandarin">Bahasa Mandarin</option>
											<option value="Bahasa Inggris">Bahasa Inggris</option>
										</select>
										<script>
										function refresh() {
											window.location = "view-jadwal-kbm.php?paket=" + document.getElementById('pilihPaket').value;
										}
										</script>
									</div><br/><br/>
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Paket</th>
													<th>Tingkat</th>
													<th>Kelas</th>
													<th>Hari</th>
													<th>Jam</th>
													<th>Tentor</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$listJadwal = mysqli_query($db, "SELECT kbm.*, tentor.namaTentor FROM `kbm`, `tentor` WHERE kbm.tentor = tentor.idTentor");
												if (isset($_GET['paket'])) {
													$listJadwal = mysqli_query($db, "SELECT kbm.*, tentor.namaTentor FROM `kbm`, `tentor` WHERE kbm.paket = '$_GET[paket]' AND kbm.tentor = tentor.idTentor");
												}
												if (mysqli_num_rows($listJadwal) > 0 ) {
													while($data = mysqli_fetch_array($listJadwal)) {
												?>
												<tr>
													<td><?php echo $data['paket']; ?></td>
													<td><?php echo $data['tingkat']; ?></td>
													<td><?php echo $data['kelas']; ?></td>
													<td><?php echo $data['hariMengajar']; ?></td>
													<td><?php echo $data['jamMulai'] . "-" . $data['jamAkhir']; ?></td>
													<td><?php echo $data['namaTentor']; ?></td>
													<td>
														<a href="edit-jadwal-kbm.php?id=<?php echo $data['id']; ?>" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></a>
														<a href="delete-jadwal-kbm.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
													</td>
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