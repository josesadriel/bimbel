<?php
session_start();
include("koneksi.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <title>Login | Bimbel Ayen</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand">Ayen Medan</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/akademik.php">Akademik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about-us.php">About Us</a>
          </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <a href="#" class="btn btn-primary">Login</a>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mt-3">
                <img src="img/bimbel-ayen-medan.png" class="img-fluid"/>
                <br/><br/>
                <div id="alert" class="text-danger" style="display:none">
                	<center>Username / Password tidak sesuai</center>
                </div>
	                <form action="" class="col-lg-6 offset-lg-3" method="post">
	                	<table class="table-responsive justify-content-center">
		                	<tr>
			                	<td width="50%">Username / ID</td>
				                <td width="50%"><div class="d-flex">: <input type="text" name="username" class="form-control" /></div></td>
							</tr>
							<tr>
								<td width="50%">Password</td>
								<td width="50%"><div class="d-flex">: <input type="password" name="pass" class="form-control" /></div></td>
		                	</tr>
		                </table><br/>
						<input type="submit" class="btn btn-primary btn-block" name="login" value="Login" />
					</form>
					<?php
					if (isset($_POST['login'])) {
						$username = $_POST['username'];
						$password = $_POST['pass'];
						
						$cekData = mysqli_query($db, "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'");
						if (mysqli_num_rows($cekData) > 0) {
						    while($data = mysqli_fetch_array($cekData)) {
						    $_SESSION['username'] = $username;
                $_SESSION['id'] = $data['idLain'];
                $_SESSION['role'] = $data['role'];
                echo "<meta http-equiv='refresh' content='0; url=home.php'>";
                }
						}
						else echo "<script>document.getElementById('alert').style.display='inline';</script>";
					}
					?>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>