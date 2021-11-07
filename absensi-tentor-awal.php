<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Absensi Tentor</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Absensi Tentor</h6>
								</div>
								<div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                Tanggal Absensi: <?= date("d F Y, H:i"); ?><br/>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                                <?php
                                                $indeks = 0;
                                                $jamNow = date("H:m:s");
                                                $jamAjar= mysqli_query($db, "SELECT kbm.kelas, kbm.paket, kbm.jamMulai, kbm.jamAkhir, tentor.namaTentor FROM `kbm`, `tentor` WHERE kbm.tentor = tentor.idTentor AND tentor = '$_SESSION[id]' AND HOUR(CURRENT_TIME()) = (HOUR(jamMulai)-1) AND tentor NOT IN (SELECT idTentor FROM `absensi_tentor` WHERE paket = kbm.paket AND DATE(tglAbsen) = CURRENT_DATE) ORDER BY jamMulai ASC LIMIT 1");
                                                $jumlahRowAbsen = mysqli_num_rows($jamAjar);
                                                if ($jumlahRowAbsen > 0) {
                                                    while ($list = mysqli_fetch_array($jamAjar)) {
                                                        $jamMulai = $list['jamMulai'];
                                                        $jamAkhir = $list['jamAkhir'];
                                                        $nama = $list['namaTentor'];
                                                        $paket = $list['paket'];
                                                        $kelas = $list['kelas'];
                                                ?>
                                                    Jam: <?= $jamMulai . "-" . $jamAkhir; ?><br/>
                                                <?php
                                                    $indeks++;
                                                    }
                                                }
                                                ?><br/>
                                            </div>
                                        </div>
                                        <div class="table-responsive" style="display:none">
                                            <table border="1" cellspacing="0">
                                            <?php
                                            $indeksPrev = 0;
                                            $dataPrev = mysqli_query($db, "SELECT kbm.kelas, kbm.paket, kbm.jamMulai, kbm.jamAkhir, tentor.namaTentor FROM `kbm`, `tentor` WHERE (kbm.tentor, kbm.paket) NOT IN (SELECT idTentor, paket FROM `absensi_tentor` WHERE DATE(tglAbsen) = CURRENT_DATE()) AND (CURRENT_TIME() > kbm.jamMulai OR CURRENT_TIME > jamAkhir) AND kbm.tentor = '$_SESSION[id]' AND kbm.tentor = tentor.idTentor ORDER BY jamMulai ASC");
                                            $jumlahRow = mysqli_num_rows($dataPrev);
                                            echo $jumlahRow;
                                            if ($jumlahRow > 0) {
                                                while($aPrev = mysqli_fetch_array($dataPrev)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="radio" name="data[<?= $indeksPrev; ?>][kelas]" value="<?= $aPrev['kelas']; ?>" checked/>
                                                    <?= $aPrev['kelas']; ?>
                                                <td>
                                                <td>
                                                    <input type="radio" name="data[<?= $indeksPrev; ?>][paket]" value="<?= $aPrev['paket']; ?>" checked/>
                                                    <?= $aPrev['paket']; ?>
                                                </td>
                                                <td>
                                                    <input type="radio" name="data[<?= $indeksPrev; ?>][jam]" value="<?= $aPrev['jamMulai'] . "-" . $aPrev['jamAkhir']; ?>" checked/>
                                                    <?= $aPrev['jamMulai'] . "-" . $aPrev['jamAkhir']; ?>
                                                </td>
                                                <td>
                                                    <input type="radio" name="data[<?= $indeksPrev; ?>][nama]" value="<?= $aPrev['namaTentor']; ?>" checked/>
                                                    <?= $aPrev['namaTentor']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($jamNow >= $aPrev['jamMulai'] && $jamNow < $aPrev['jamAkhir']) {
                                                    ?>
                                                        <input id="terlambat<?= $indeksPrev; ?>" type="radio" name="data[<?= $indeksPrev; ?>][ket]" value="Terlambat" checked/>
                                                        <label for="terlambat<?= $indeksPrev; ?>">Terlambat</label>
                                                    <?php
                                                    }
                                                    else if ($jamNow > $aPrev['jamAkhir'] || (date("H", $jamNow) == $aPrev['jamAkhir'] && date("m", $jamNow) > date("m", $jamAkhir))) {
                                                    ?>
                                                        <input id="tdkHadir<?= $indeksPrev; ?>" type="radio" name="data[<?= $indeksPrev; ?>][ket]" value="Tidak Hadir" checked/>
                                                        <label for="tdkHadir<?= $indeksPrev; ?>">Tidak Hadir</label>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                                $indeksPrev++;
                                                }
                                            }
                                            ?>
                                            </table>
                                        </div>
                                        <center><input type="submit" name="absen" value="Absensi" class="btn btn-primary" <?= ($jumlahRowAbsen == 0 || $jumlahRowAbsen == null) ? "style='display:none'" : ""; ?> /></center>
                                    </form>
                                    <?php
                                    if (isset($_POST['absen'])) {
                                        $idTentor = $_SESSION['id'];
                                        $tglAbsen = date("Y-m-d H:i:s");
                                        $sql = "INSERT INTO `absensi_tentor` (idTentor, namaTentor, jamMulai, jamAkhir, tglAbsen, paket, kelas, keterangan) VALUES ";
                                        if (isset($_POST['data'])) {
                                            $data = $_POST['data'];
                                            for ($i = 0 ; $i < count($data); $i++) {
                                                $jam = explode("-", $data[$i]['jam']);
                                                $sql .= "('" . $idTentor . "','" . $data[$i]['nama'] ."', '" . $jam[0] . "', '" . $jam[1] . "', '" . $tglAbsen . "', '" . $data[$i]['paket'] . "', '" . $data[$i]['kelas'] . "', '" . $data[$i]['ket'] . "')";
                                                if($i < (count($data) - 1)){
                                                    $sql .=", ";
                                                }
                                            }
                                        }
                                        else if (!isset($_POST['data'])){
                                            $sql .= "('" . $idTentor ."', '" . $nama . "', '". $jamMulai . "', '". $jamAkhir . "', '" . $tglAbsen . "', '" . $paket . "', '" . $kelas . "', 'Hadir')";
                                        }
                                        else $sql .= ", ('" . $idTentor ."', '" . $data[$i]['nama'] . "', '". $jamMulai . "', '". $jamAkhir . "', '" . $tglAbsen . "', '" . $paket . "', '" . $kelas . "', 'Hadir')";
                                        $inputData = mysqli_query($db, $sql);
                                        if ($inputData) {
                                            echo "sukses";
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