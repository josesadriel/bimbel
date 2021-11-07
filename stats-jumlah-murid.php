<?php
include("koneksi.php");
session_start();
?>
<html>
    <head>
        <title>Statistik Jumlah Murid</title>
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
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Statistik Jumlah Murid</h6>
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-center">
										Tahun:
										<select name="tahun" class="form-control col-4 ml-3" onchange="window.location = '?tahun=' + this.value">
											<option value="">Pilih</option>
											<?php
											$listTahun = mysqli_query($db, "SELECT YEAR(tglDaftar) 'tahun' FROM `murid` GROUP BY YEAR(tglDaftar)");
											while($tahun = mysqli_fetch_array($listTahun)) {
											?>
											<option value="<?= $tahun['tahun']; ?>"><?= $tahun['tahun']; ?></option>
											<?php
											}
											?>
										</select>
									</div><br/><br/>
									<div class="chart-bar">
										<canvas id="myBarChart"></canvas>
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
	<script src="vendor/chart.js/Chart.min.js"></script>
	<script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	// Bar Chart Example
	var ctx = document.getElementById("myBarChart");
	var myBarChart = new Chart(ctx, {
	  type: 'bar',
	  data: {
		<?php
		$tingkat = mysqli_query($db, "SELECT tingkat, count(idMurid) 'jumlah' FROM `murid` GROUP BY tingkat");
		if (isset($_GET['tahun'])) $tingkat = mysqli_query($db, "SELECT tingkat, count(idMurid) 'jumlah' FROM `murid` WHERE YEAR(tglDaftar) = '$_GET[tahun]' GROUP BY tingkat");
		$label = "";
		$data = "";
		while ($labelTingkat = mysqli_fetch_array($tingkat)) {
			$label .= ", " . $labelTingkat['tingkat'];
			$data .= ", " . $labelTingkat['jumlah'];
		}
		if ($label) $label = substr($label, 2);
		if ($data) $data = substr($data, 2);
		?>
		labels: <?= json_encode(explode(", ", $label)); ?>,
		datasets: [{
		  label: "Jumlah",
		  backgroundColor: "#4e73df",
		  hoverBackgroundColor: "#2e59d9",
		  borderColor: "#4e73df",
		  data: [<?= $data; ?>],
		}],
	  },
	  options: {
		maintainAspectRatio: false,
		layout: {
		  padding: {
			left: 10,
			right: 25,
			top: 25,
			bottom: 0
		  }
		},
		scales: {
		  xAxes: [{
			time: {
			  unit: 'month'
			},
			gridLines: {
			  display: false,
			  drawBorder: false
			},
			ticks: {
			  maxTicksLimit: 6
			},
			maxBarThickness: 25,
		  }],
		  yAxes: [{
			ticks: {
			  min: 0,
			  <?php
			  $yMax = mysqli_query($db, "SELECT count(idMurid) 'jumlah' FROM `murid` LIMIT 1");
			  $maks = 0;
			  while ($total = mysqli_fetch_array($yMax)) {
				$maks = $total['jumlah'];
			  }
			  ?>
			  max: <?= $maks; ?>,
			  maxTicksLimit: 5,
			  padding: 10,
			  // Include a dollar sign in the ticks
			  callback: function(value, index, values) {
				return value;
			  }
			},
			gridLines: {
			  color: "rgb(234, 236, 244)",
			  zeroLineColor: "rgb(234, 236, 244)",
			  drawBorder: false,
			  borderDash: [2],
			  zeroLineBorderDash: [2]
			}
		  }],
		},
		legend: {
		  display: false
		},
		tooltips: {
		  titleMarginBottom: 10,
		  titleFontColor: '#6e707e',
		  titleFontSize: 14,
		  backgroundColor: "rgb(255,255,255)",
		  bodyFontColor: "#858796",
		  borderColor: '#dddfeb',
		  borderWidth: 1,
		  xPadding: 15,
		  yPadding: 15,
		  displayColors: false,
		  caretPadding: 10,
		  callbacks: {
			label: function(tooltipItem, chart) {
			  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
			  return datasetLabel + ': ' + tooltipItem.yLabel + ' orang';
			}
		  }
		},
	  }
	});
	</script>
</body>
</html>