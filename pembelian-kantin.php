<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Pembelian di Kantin</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Pembelian di Kantin</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tanggal Pembelian:<br/>
												<input type="date" name="tglBeli" class="form-control col-8" value="<?= date("Y-m-d"); ?>" required/><br/>
												Kode:<br/>
												<select name="kodeBarang" id="kodeBarang" class="form-control col-8" onchange="getHarga(this.value)" required>
													<option value="" disabled selected>Pilih</option>
													<?php
													$listItem = mysqli_query($db, "SELECT * FROM `kantin`");
													while ($item = mysqli_fetch_array($listItem)) {
													?>
													<option value="<?= $item['kodeKantin'] . "|" . $item['harga']; ?>"><?=  $item['kodeKantin'] . " - " . $item['nama']; ?></option>
													<?php
													}
													?>
												</select><br/>
												ID Murid: <br/>
												<select name="idMurid" class="form-control col-8" required>
													<option value="" disabled selected>Pilih</option>
													<?php
													$listMurid = mysqli_query($db, "SELECT * FROM `murid`");
													while ($murid = mysqli_fetch_array($listMurid)) {
													?>
													<option value="<?= $murid['idMurid']; ?>"><?= $murid['idMurid'] . " - " . $murid['namaMurid']; ?></option>
													<?php
													}
													?>
												</select><br/>
												Kuantitas:<br/>
												<input type="number" class="form-control col-8" name="kuantitas" oninput="hitungHarga(this.value)" required/><br/>
												Harga:<br/>
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1">Rp.</span>
													</div>
													<input type="text" class="form-control" name="harga" id="harga" readonly required />
												</div>
												<script>
												function getHarga(harga) {
													var split = harga.split("|");
													var jenis = split[0].substring(0,2);
													if (jenis == "AT") document.getElementById('jenis').value = "Alat Tulis";
													else if (jenis == "MA") document.getElementById('jenis').value = "Makanan";
													return split[1];
												}
												function hitungHarga(kuantitas) {
													var hSatuan = getHarga(document.getElementById('kodeBarang').value);
													var hasil = hSatuan * kuantitas;
													document.getElementById('harga').value = hasil;
												}
												</script>
												Pembayaran:<br/>
												<div class="form-check form-check-inline">
													<input type="radio" id="cash" class="form-check-input" name="pembayaran" value="Cash" required/>
													<label for="cash" class="form-check-label">Cash</label>
													<input type="radio" id="ovo" class="form-check-input ml-2" name="pembayaran" value="OVO"/>
													<label for="ovo" class="form-check-label">OVO</label>
													<input type="radio" id="dana" class="form-check-input ml-2" name="pembayaran" value="DANA"/>
													<label for="dana" class="form-check-label">DANA</label>
													<input type="radio" id="hutang" class="form-check-input ml-2" name="pembayaran" value="Hutang"/>
													<label for="hutang" class="form-check-label">Hutang</label>
												</div><br/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis:<br/>
												<select name="jenis" id="jenis" class="form-control col-6" required>
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
										$tglBeli = date("Y-m-d", strtotime($_POST['tglBeli']));
										$kodeItem = explode("|", $_POST['kodeBarang']);
										$kodeItem = $kodeItem[0];
										$idMurid = $_POST['idMurid'];
										$kuantitas = $_POST['kuantitas'];
										$harga = $_POST['harga'];
										$pembayaran = $_POST['pembayaran'];
										$jenis = $_POST['jenis'];
										
										$inputSql = mysqli_query($db, "INSERT INTO `pembelian_kantin` (kodeKantin, idMurid, kuantitas, harga, jenis, pembayaran, tglBeli) VALUES ('$kodeItem', '$idMurid', '$kuantitas', '$harga', '$jenis', '$pembayaran', '$tglBeli')");
										
										if ($inputSql) {
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