<?php
include("koneksi.php");
$idTentor = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `tentor` WHERE idTentor = '$idTentor'");
$deleteUserSql = mysqli_query($db, "DELETE FROM `user` WHERE idLain = '$idTentor'");
$deleteAbsen = mysqli_query($db, "DELETE FROM `absensi_tentor` WHERE idTentor = '$idTentor'");
$deleteKbm = mysqli_query($db, "DELETE FROM `kbm` WHERE tentor = '$idTentor'");
$deletePembayaran = mysqli_query($db, "DELETE FROM `pembayarantentor` WHERE idTentor = '$idTentor'");
if ($deleteSql && $deleteUserSql && $deleteAbsen && $deleteKbm && $deletePembayaran) {
	header('Location: view-data-tentor.php');
}
?>