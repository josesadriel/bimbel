<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Input Nilai Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Nilai Murid</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Mata Pelajaran:<br/>
                                                <select name="mapel" class="form-control col-8" onchange="getData('mapel', this.value)" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <?php
                                                    $listMapel = mysqli_query($db, "SELECT * FROM `mata_pelajaran`");
                                                    if (isset($_GET['tingkat'])) $listMapel = mysqli_query($db, "SELECT * FROM `mata_pelajaran` WHERE tingkat = '$_GET[tingkat]'");
                                                    while ($lMapel = mysqli_fetch_array($listMapel)) {
                                                    ?>
                                                    <option value="<?= $lMapel['pelajaran']; ?>" <?= (isset($_GET['mapel']) && $_GET['mapel'] == $lMapel['pelajaran']) ? "selected" : ""; ?>><?= $lMapel['pelajaran'] . " (" . $lMapel['tingkat'] . ")"; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select><br/>
                                                ID Murid:<br/>
                                                <select name="murid" class="form-control col-8" onchange="getData('id', this.value)" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <?php
                                                    $paketTentor = "";
                                                    $getPaket = mysqli_query($db, "SELECT * FROM `kbm` WHERE tentor = '$_SESSION[id]'");
                                                    while ($gPaket = mysqli_fetch_array($getPaket)) {
                                                        $paketTentor .= '|' . $gPaket['paket'];
                                                    }
                                                    $paketTentor = substr($paketTentor, 1);
                                                    $listMurid = mysqli_query($db, "SELECT murid.idMurid, murid.namaMurid FROM `murid`, `kbm` WHERE murid.paket REGEXP '$paketTentor' AND kbm.paket REGEXP '$paketTentor' AND murid.kelas = kbm.kelas AND kbm.tentor = '$_SESSION[id]' GROUP BY murid.idMurid");
                                                    if (isset($_GET['tingkat'])) $listMurid = mysqli_query($db, "SELECT murid.idMurid, murid.namaMurid FROM `murid`, `kbm` WHERE murid.paket REGEXP '$paketTentor' AND kbm.paket REGEXP '$paketTentor' AND murid.kelas = kbm.kelas AND kbm.tentor = '$_SESSION[id]' AND murid.tingkat = '$_GET[tingkat]' GROUP BY murid.idMurid");
                                                    while ($lMurid = mysqli_fetch_array($listMurid)) {
                                                    ?>
                                                    <option value="<?= $lMurid['idMurid'] . "-" . $lMurid['namaMurid']; ?>" <?= (isset($_GET['id']) && $_GET['id'] == $lMurid['idMurid'] . '-' . $lMurid['namaMurid']) ? "selected" : ""; ?>><?= $lMurid['idMurid'] . " - " . $lMurid['namaMurid']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select><br/>
                                                Jenis:<br/>
                                                <div class="d-flex justify-content">
                                                    <select name="jenis" class="form-control col-4" onchange="getData('jenis', this.value)" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <option value="UH" <?= (isset($_GET['jenis']) && $_GET['jenis'] == "UH") ? "selected" : ""; ?>>UH</option>
                                                        <option value="UTS" <?= (isset($_GET['jenis']) && $_GET['jenis'] == "UTS") ? "selected" : ""; ?>>UTS</option>
                                                        <option value="UAS" <?= (isset($_GET['jenis']) && $_GET['jenis'] == "UAS") ? "selected" : ""; ?>>UAS</option>
                                                    </select>
                                                    <input type="number" min="1" name="ulanganKeX" class="form-control col-4" placeholder="XX" <?= (isset($_GET['jenis']) && $_GET['jenis'] == 'UH') ? "style='display:inline' required" : "style='display:none'";?> required/>
                                                </div>
                                                <br/>
                                                Nilai:<br/>
                                                <input type="number" name="nilai" class="form-control col-4" required/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tingkatan:<br/>
                                                <select name="tingkat" class="form-control col-6" onchange="getData('tingkat', this.value)" required>
                                                    <option value="" disabled selected>Pilih</option>
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
										<center>
											<input type="submit" class="btn btn-primary" name="save" value="Save"/>
										</center>
									</form>
									<?php
									if (isset($_POST['save'])) {
                                        $mapel = $_POST['mapel'];
                                        $murid = explode("-", $_POST['murid']);
                                        $id = $murid[0];
                                        $nama = $murid[1];
                                        $jenis = $_POST['jenis'];
                                        $nilai = $_POST['nilai'];
                                        $tingkat = $_POST['tingkat'];
                                        $sql = "INSERT INTO `nilai_murid` (idMurid, namaMurid, mapel, tingkat, jenis, nilai) VALUES ('$id', '$nama', '$mapel', '$tingkat', '$jenis', '$nilai')";
                                        if ($jenis == "UH") {
                                            $x = $_POST['ulanganKeX']-1;
                                            $cekNilai = mysqli_query($db, "SELECT * FROM `nilai_murid` WHERE idMurid = '$id' AND mapel = '$mapel' AND jenis = 'UH'");
                                            if (mysqli_num_rows($cekNilai) > 0) {
                                                while ($cNilai = mysqli_fetch_array($cekNilai)) {
                                                    if (isset($cNilai['nilai'])) {
                                                        $nilaiAwal = explode("|", $cNilai['nilai']);
                                                        for ($i = 0; $i <= $x; $i++) {
                                                            if (!isset($nilaiAwal[$i])) $nilaiAwal[$i] = "";
                                                            if (isset($nilaiAwal[$i]) && $i == $x) $nilaiAwal[$i] = $nilai;
                                                        }
                                                        $nilaiBaru = implode("|", $nilaiAwal);
                                                        $sql = "UPDATE `nilai_murid` SET nilai = '$nilaiBaru' WHERE idMurid = '$id' and mapel = '$mapel' AND jenis = 'UH'";
                                                    }
                                                }
                                            }
                                            else {
                                                $urutanUlangan = "";
                                                if ($x > 0) {
                                                    for ($i = 0; $i < $x; $i++) {
                                                        $urutanUlangan .= "|";
                                                    }
                                                    $urutanUlangan .= $nilai;
                                                }
                                                else if ($x == 0) $urutanUlangan = $nilai;
                                                $sql = "INSERT INTO `nilai_murid` (idMurid, namaMurid, mapel, tingkat, jenis, nilai) VALUES ('$id', '$nama', '$mapel', '$tingkat', '$jenis', '$urutanUlangan')";
                                            }
                                        }
                                        $inputSql = mysqli_query($db, $sql);
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