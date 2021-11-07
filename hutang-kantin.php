<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Daftar Hutang</title>
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
									<h6 class="m-0 font-weight-bold text-primary">Daftar Hutang</h6>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID Murid</th>
													<th>Nama Murid</th>
													<th>Nama Barang</th>
													<th>Kuantitas</th>
													<th>Harga</th>
													<th>Tanggal Pembelian</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$total = 0;
												$listDataKantin = mysqli_query($db, "SELECT pembelian_kantin.*, murid.namaMurid, kantin.nama FROM `pembelian_kantin`, `murid`, `kantin` WHERE pembelian_kantin.idMurid = murid.idMurid AND pembelian_kantin.kodeKantin = kantin.kodeKantin AND pembelian_kantin.pembayaran = 'Hutang';");
												if (mysqli_num_rows($listDataKantin) > 0 ) {
													while($data = mysqli_fetch_array($listDataKantin)) {
														$total += $data['harga'];
												?>
												<tr>
													<td><a href="detail-hutang.php?id=<?= $data['idMurid']; ?>"><?= $data['idMurid']; ?></a></td>
													<td><?= $data['namaMurid']; ?></td>
													<td><?= $data['nama']; ?></td>
													<td><?= $data['kuantitas']; ?></td>
													<td><?= number_format($data['harga'],0,',','.'); ?></td>
													<td><?= $data['tglBeli']; ?></td>
													<td>
														<a href="?id=<?= $data['id_pembelian']; ?>" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-pencil-alt"></i></a>
													</td>
												</tr>
												<?php
													}
												}
												?>
											</tbody>
										</table>
										<div class="text-right"><b>Total</b>: Rp. <?= number_format($total,0,',','.'); ?></div>
										<!-- Modal -->
										<?php
										if (isset($_GET['id'])) {
											echo "<script>";
											echo "$(document).ready(function(){";
											echo "$('#hutang').modal('show');";
											echo "}); </script>";
											$dataHutang = mysqli_query($db, "SELECT pembelian_kantin.*, murid.namaMurid, kantin.nama FROM `pembelian_kantin`, `murid`, `kantin` WHERE pembelian_kantin.idMurid = murid.idMurid AND pembelian_kantin.kodeKantin = kantin.kodeKantin AND pembelian_kantin.pembayaran = 'Hutang' AND pembelian_kantin.id_pembelian = '$_GET[id]';");
											while($dHutang = mysqli_fetch_array($dataHutang)) {
										?>
										<div class="modal fade" id="hutang" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalCenterTitle">Hutang <?= $dHutang['namaMurid'] . " - " . $dHutang['tglBeli']; ?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="" method="post">
														<div class="modal-body">
															Nama Murid: <?= $dHutang['namaMurid'];?><br/>
															Nama Barang: <?= $dHutang['nama'];?><br/>
															Harga: <?= $dHutang['harga']; ?><br/>
															Tanggal Pembelian: <?= $dHutang['tglBeli'];?><br/>
															<br/>
															<center>
																Metode pembayaran pelunasan hutang:<br/>
																<select name="metode" class="form-control col-4">
																	<option value="Cash">Cash</option>
																	<option value="OVO">OVO</option>
																	<option value="DANA">DANA</option>
																</select>
															</center>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															<input type="submit" class="btn btn-primary" name="edit" value="Edit"/>
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php
											}
											if (isset($_POST['edit'])) {
												$updateSql = mysqli_query($db, "UPDATE `pembelian_kantin` SET `pembayaran` = '$_POST[metode]' WHERE `id_pembelian` = '$_GET[id]';");
												if ($updateSql) {
													echo "<meta http-equiv='refresh' content='0; url=hutang-kantin.php'>";
												}
											}
										}
										?>
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