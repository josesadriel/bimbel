<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Edit Biaya Bimbingan</title>
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
								<strong>Data Biaya Bimbingan berhasil diubah!</strong>
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
									<h6 class="m-0 font-weight-bold text-primary">Edit Biaya Bimbingan</h6>
								</div>
								<div class="card-body">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $getData = mysqli_query($db, "SELECT * FROM `biaya_bimbingan` WHERE id = '$_GET[id]'");
                                        while($data = mysqli_fetch_array($getData)) {
                                    ?>
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis Paket:<br/>
												<select name="paket" class="form-control col-6" required>
													<option value="" disabled selected>Pilih</option>
													<option value="Bimbel" <?= ($data['paket'] == "Bimbel") ? "selected" : ""; ?>>Bimbel</option>
													<option value="MAFIA" <?= ($data['paket'] == "MAFIA") ? "selected" : ""; ?>>MAFIA</option>
													<option value="Bahasa Mandarin" <?= ($data['paket'] == "Bahasa Mandarin") ? "selected" : ""; ?>>Bahasa Mandarin</option>
													<option value="Bahasa Inggris" <?= ($data['paket'] == "Bahasa Inggris") ? "selected" : ""; ?>>Bahasa Inggris</option>
												</select>
												<br/>
												Biaya bimbingan:<br/>
												<input type="number" name="biaya" class="form-control col-6" value="<?= $data['biaya']; ?>" required/>
												<br/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
												<select name="tingkatan" class="form-control col-6" required>
													<option value="" disabled selected>Pilih</option>
													<option value="TK" <?= ($data['tingkat'] == "TK") ? "selected" : ""; ?>>TK</option>
													<option value="SD" <?= ($data['tingkat'] == "SD") ? "selected" : ""; ?>>SD</option>
													<option value="SMP" <?= ($data['tingkat'] == "SMP") ? "selected" : ""; ?>>SMP</option>
													<option value="SMA" <?= ($data['tingkat'] == "SMA") ? "selected" : ""; ?>>SMA</option>
												</select><br/>
											</div>
										</div>
										<center>
											<input type="submit" class="btn btn-primary" name="edit" value="Save"/>
											<input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
										</center>
									</form>
									<?php
                                        }
                                    }
									if (isset($_POST['edit'])) {
										$paket = $_POST['paket'];
										$biaya = $_POST['biaya'];
										$tingkatan = $_POST['tingkatan'];
										
										$updateBiaya = mysqli_query($db, "UPDATE `biaya_bimbingan` SET paket = '$paket', tingkat = '$tingkatan', biaya = '$biaya' WHERE id = '$_GET[id]'");
										if ($updateBiaya) {
                                            echo "<script>document.getElementById('alert').style.display='inline';</script>";
                                            echo "<meta http-equiv='refresh' content='2; url=biaya-bimbingan.php'>";
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