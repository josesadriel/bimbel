<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Absensi Murid</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Absensi Murid</h6>
								</div>
								<div class="card-body">
									<form action="" method="post">
										<div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Tanggal Absensi: <?= date("d F Y"); ?><br/><br/>
                                                Tingkatan:<br/>
                                                <select name="tingkat" class="form-control col-6" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <option value="TK" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "TK") ? "selected" : "" ?>>TK</option>
                                                    <option value="SD" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SD") ? "selected" : "" ?>>SD</option>
                                                    <option value="SMP" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SMP") ? "selected" : "" ?>>SMP</option>
                                                    <option value="SMA" <?= (isset($_GET['tingkat']) && $_GET['tingkat'] == "SMA") ? "selected" : "" ?>>SMA</option>
                                                </select><br/>
                                                Kelas:<br/>
                                                <input type="text" name="kelas" class="form-control col-6" value="<?= $_GET['kelas'] ?? ''; ?>" required/>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
												Jenis Paket:<br/>
                                                <select name="paket" class="form-control col-6" required>
                                                    <option value="" disabled selected>Pilih</option>
                                                    <option value="Bimbel" <?= (isset($_GET['paket']) && $_GET['paket'] == "Bimbel") ? "selected" : "" ?>>Bimbel</option>
                                                    <option value="MAFIA" <?= (isset($_GET['paket']) && $_GET['paket'] == "MAFIA") ? "selected" : "" ?>>MAFIA</option>
                                                    <option value="Bahasa Inggris" <?= (isset($_GET['paket']) && $_GET['paket'] == "Bahasa Inggris") ? "selected" : "" ?>>Bahasa Inggris</option>
                                                    <option value="Bahasa Mandarin" <?= (isset($_GET['paket']) && $_GET['paket'] == "Bahasa Mandarin") ? "selected" : "" ?>>Bahasa Mandarin</option>
                                                </select>
											</div>
										</div>
                                        <input type="submit" class="btn btn-primary btn-block" value="Tampilkan" name="show"/>
                                    </form>
                                    <?php
                                    if (isset($_POST['show'])) {
                                        $tingkatan = $_POST['tingkat'];
                                        $paket = $_POST['paket'];
                                        $kelas = $_POST['kelas'];
                                        echo "<meta http-equiv='refresh' content='0; url=absensi-murid.php?tingkat=$tingkatan&paket=$paket&kelas=$kelas'>";
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID Murid</th>
													<th>Nama Murid</th>
													<th>Jam</th>
													<th>Absensi</th>
                                                    <th>Keterangan</th>
                                                    <th>Petugas</th>
												</tr>
											</thead>
											<tbody>
												<?php
                                                if (isset($_GET['tingkat']) && isset($_GET['paket']) && isset($_GET['kelas'])) {
                                                    $tingkat = $_GET['tingkat'];
                                                    $paket = $_GET['paket'];
                                                    $kelas = $_GET['kelas'];
                                                    $indexData = 0;
                                                    $tglSekarang = date("Y-m-d");

                                                    $dataList = mysqli_query($db, "SELECT murid.idMurid, murid.namaMurid, kbm.jamMulai, kbm.jamAkhir, kbm.paket  FROM `murid`, `kbm` WHERE murid.paket LIKE '%$paket%' AND kbm.paket LIKE '%$paket%' AND murid.kelas = '$kelas' AND murid.idMurid NOT IN (SELECT absensi_murid.idMurid FROM `absensi_murid` WHERE absensi_murid.tanggalAbsen = '$tglSekarang' AND absensi_murid.paket = '$paket') AND kbm.tentor = '$_SESSION[id]' AND kbm.kelas = murid.kelas");
                                                    if (mysqli_num_rows($dataList)) {
                                                        while ($dList = mysqli_fetch_array($dataList)) {
												?>
												<tr>
													<td>
                                                        <input type="radio" name="val[<?= $indexData; ?>][id]" value="<?= $dList['idMurid']; ?>" checked style="display:none" />
                                                        <?=$dList['idMurid'];?>
                                                    </td>
													<td>
                                                        <input type="radio" name="val[<?= $indexData; ?>][nama]" value="<?= $dList['namaMurid']; ?>" checked style="display:none" />
                                                        <?= $dList['namaMurid'];?>
                                                    </td>
													<td>
                                                        <input type="radio" name="val[<?= $indexData; ?>][jam]" value="<?= date("H:i", strtotime($dList['jamMulai'])) . "-" . date("H:i", strtotime($dList['jamAkhir'])); ?>" checked style="display:none" />
                                                        <?= date("H:i", strtotime($dList['jamMulai'])) . "-" . date("H:i", strtotime($dList['jamAkhir'])); ?>
                                                    </td>
													<td>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="val[<?= $indexData; ?>][absen]" value="Hadir" id="hadir<?= $indexData; ?>" class="form-check-input" />
                                                            <label for="hadir<?= $indexData; ?>" class="form-check-label">Hadir</label>
                                                            <input type="radio" name="val[<?= $indexData; ?>][absen]" value="Ijin" id="ijin<?= $indexData; ?>" class="form-check-input ml-2" />
                                                            <label for="ijin<?= $indexData; ?>" class="form-check-label">Ijin</label>
                                                            <input type="radio" name="val[<?= $indexData; ?>][absen]" value="Alpha" id="alpha<?= $indexData; ?>" class="form-check-input ml-2" />
                                                            <label for="alpha<?= $indexData; ?>" class="form-check-label">Alpha</label>
                                                            <input type="radio" name="val[<?= $indexData; ?>][absen]" value="Sakit" id="sakit<?= $indexData; ?>" class="form-check-input ml-2" />
                                                            <label for="sakit<?= $indexData; ?>" class="form-check-label">Sakit</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="val[<?= $indexData; ?>][ket]" value="-" class="form-control"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="val[<?= $indexData; ?>][petugas]" class="form-control" value="-"/>
                                                    </td>
												</tr>
												<?php
                                                            $indexData++;
													    }
                                                    }
                                                }
												?>
											</tbody>
										</table>
                                        </div>
										<center>
											<input type="submit" class="btn btn-primary" name="save" value="Save" id="save"/>
										</center>
									</form>
									<?php
									if (isset($_POST['save']) && isset($_POST['val'])) {
                                        $val = array_values(array_filter($_POST['val'], function($value) { return isset($value['absen']); }));
                                        $tglAbsen = date("Y-m-d");
                                        $inputSql = "INSERT INTO `absensi_murid` (idMurid, namaMurid, jamMulai, tingkat, paket, kelas, tanggalAbsen, absensi, keterangan, petugas) VALUES ";

                                        for ($i = 0 ; $i < count($val); $i++) {
                                            $inputSql .= "('" . $val[$i]['id'] . "','" . $val[$i]['nama'] ."', '" . $val[$i]['jam'] . "', '" . $_GET['tingkat'] . "', '" . $_GET['paket'] . "', '" . $_GET['kelas'] . "', '" . $tglAbsen . "', '" . $val[$i]['absen'] . "', '" . $val[$i]['ket'] . "', '" . $val[$i]['petugas'] . "')";
                                            if($i < (count($val) - 1)){
                                                $inputSql .=", ";
                                            }
                                        }
                                        $sql = mysqli_query($db, $inputSql);
                                        if ($sql) {
											echo "<script>document.getElementById('alert').style.display='inline'; </script>";
											echo "<meta http-equiv='refresh' content='2; url=absensi-murid.php?tingkat=$tingkat&paket=$paket&kelas=$kelas'>";
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