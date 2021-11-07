<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Edit Honor Tentor</title>
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
								<strong>Data Honor Tentor berhasil diubah!</strong>
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
									<h6 class="m-0 font-weight-bold text-primary">Edit Honor Tentor</h6>
								</div>
								<div class="card-body">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $getData = mysqli_query($db, "SELECT * FROM `honor_tentor` WHERE id = '$_GET[id]'");
                                        while ($data = mysqli_fetch_array($getData)) {
                                    ?>
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis Tentor:<br/>
												<div class="form-check form-check-inline">
													<input type="radio" id="jenis1" name="jenisTentor" value="Harian" class="form-check-input" <?= ($data['jenisTentor'] == "Harian") ? "checked" : ""; ?>/>
													<label for="jenis1" class="form-check-label">Harian</label><br/>
													<input type="radio" id="jenis2" name="jenisTentor" value="Tetap" class="form-check-input ml-2" <?= ($data['jenisTentor'] == "Tetap") ? "checked" : ""; ?>/>
													<label for="jenis2" class="form-check-label">Tetap</label>
												</div><br/><br/>
												Jenis Paket:<br/>
												<select name="paket" class="form-control col-6">
													<option value="" disabled>Pilih</option>
													<option value="Bimbel" <?= ($data['paket'] == "Bimbel") ? "selected" : ""; ?>>Bimbel</option>
													<option value="MAFIA" <?= ($data['paket'] == "MAFIA") ? "selected" : ""; ?>>MAFIA</option>
													<option value="Bahasa Mandarin" <?= ($data['paket'] == "Bahasa Mandarin") ? "selected" : ""; ?>>Bahasa Mandarin</option>
													<option value="Bahasa Inggris" <?= ($data['paket'] == "Bahasa Inggris") ? "selected" : ""; ?>>Bahasa Inggris</option>
												</select>
												<br/>
												Honor tiap pertemuan:<br/>
												<input type="number" name="honorTentor" class="form-control col-6" value="<?= $data['honor']; ?>"/>
												<br/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<select name="tingkatan" class="form-control col-6">
													<option value="" disabled selected>Pilih</option>
													<option value="TK" <?= ($data['tingkatan'] == "TK") ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= ($data['tingkatan'] == "SD") ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= ($data['tingkatan'] == "SMP") ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= ($data['tingkatan'] == "SMA") ? "selected" : ""; ?>>SMA</option>
												</select><br/>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" name="tambah" value="Save"/>
											<input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
										</center>
									</form>
									<?php
                                        }
                                    }
									if (isset($_POST['tambah'])) {
										$jenisTentor = $_POST['jenisTentor'];
										$paket = $_POST['paket'];
										$honorTentor = $_POST['honorTentor'];
										$tingkatan = $_POST['tingkatan'];
										
										$inputHonor = mysqli_query($db, "UPDATE `honor_tentor` SET paket = '$paket', jenisTentor = '$jenisTentor', honor = '$honorTentor', tingkatan = '$tingkatan' WHERE id = '$_GET[id]'");
										if ($inputHonor) {
                                            echo "<script>document.getElementById('alert').style.display='inline';</script>";
                                            echo "<meta http-equiv='refresh' content='2; url=honor-tentor.php'>";
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