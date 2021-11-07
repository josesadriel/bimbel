<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Data Kantin</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Data Kantin</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Nama:<br/>
												<input type="text" class="form-control col-6" name="nama" required/><br/>
												Harga:<br/>
												<input type="number" class="form-control col-6" name="harga" required/><br/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis:<br/>
												<select name="jenis" class="form-control col-6">
													<option value="Makanan">Makanan</option>
													<option value="Alat Tulis">Alat Tulis</option>
												</select><br/>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" name="save" value="Save"/>
										</center>
									</form>
									<?php
									if (isset($_POST['save'])) {
										$kode = "";
										$nama = $_POST['nama'];
										$harga = $_POST['harga'];
										$jenis = $_POST['jenis'];
										if ($jenis == "Makanan") $kode = "MA";
										else if ($jenis == "Alat Tulis") $kode = "AT";
										
										$cekKantin = mysqli_query($db, "SELECT kodeKantin FROM `kantin` WHERE jenis = '$jenis' ORDER BY kodeKantin DESC LIMIT 1");
										$angkaTerakhir = 1;
										while ($cKantin = mysqli_fetch_array($cekKantin)) {
											$cutString = substr($cKantin['kodeKantin'],2);
											$angkaTerakhir = $cutString + 1;
										}
										$kode .= str_pad($angkaTerakhir, 3, '0', STR_PAD_LEFT);
										
										$inputDataKantin = mysqli_query($db, "INSERT INTO `kantin` (kodeKantin, nama, harga, jenis) VALUES ('$kode', '$nama', '$harga', '$jenis')");
										if ($inputDataKantin) {
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