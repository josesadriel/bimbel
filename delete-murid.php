<?php
include("koneksi.php");
$idMurid = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `murid` WHERE idMurid = '$idMurid'");
$deleteUserSql = mysqli_query($db, "DELETE FROM `user` WHERE idLain = '$idMurid'");
$deleteAbsen = mysqli_query($db, "DELETE FROM `absensi_murid` WHERE idMurid = '$idMurid'");
$deleteNilai = mysqli_query($db, "DELETE FROM `nilai_murid` WHERE idMurid = '$idMurid'");
$deletePembayaran = mysqli_query($db, "DELETE FROM `pembayaranmurid` WHERE idMurid = '$idMurid'");
$deletePembelian = mysqli_query($db, "DELETE FROM `pembelian_kantin` WHERE idMurid = '$idMurid'");
if ($deleteSql && $deleteUserSql && $deleteAbsen && $deleteNilai && $deletePembayaran && $deletePembelian) {
	header('Location: view-data-murid.php');
}
?>