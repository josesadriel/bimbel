<?php
include("koneksi.php");
$idPembelian = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `pembelian_kantin` WHERE id_pembelian = '$idPembelian'");
if ($deleteSql) {
	header('Location: daftar-pembelian-kantin.php');
}
?>