<?php
include("koneksi.php");
$idUser = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `user` WHERE idUser = '$idUser'");
if ($deleteSql) {
	header('Location: daftar-user.php');
}
?>