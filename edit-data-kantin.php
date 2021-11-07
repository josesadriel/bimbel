<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Edit Data Kantin</title>
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
								<strong>Data berhasil diubah!</strong>
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
									<h6 class="m-0 font-weight-bold text-primary"> Edit Data Kantin</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<?php
										if (isset($_GET['id'])) {
											$dataKantin = mysqli_query($db, "SELECT * FROM `kantin` WHERE kodeKantin = '$_GET[id]'");
											while ($dKantin = mysqli_fetch_array($dataKantin)) {
										?>
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Nama:<br/>
												<input type="text" class="form-control col-6" name="nama" value="<?= $dKantin['nama']; ?>" required/><br/>
												Harga:<br/>
												<input type="number" class="form-control col-6" name="harga" value="<?= $dKantin['harga']; ?>" required/><br/>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" name="save" value="Save"/>
										</center>
										<?php
											}
										}
										?>
									</form>
									<?php
									if (isset($_POST['save'])) {
										$nama = $_POST['nama'];
										$harga = $_POST['harga'];
										
										$updateData = mysqli_query($db, "UPDATE `kantin` SET nama = '$nama', harga = '$harga' WHERE kodeKantin = '$_GET[id]'");
										if ($updateData) {
											echo "<script>document.getElementById('alert').style.display='inline';</script>";
											echo "<meta http-equiv='refresh' content='2; url=view-data-kantin.php'>";
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