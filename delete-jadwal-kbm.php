<?php
include("koneksi.php");
$id = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `kbm` WHERE id = '$id'");
if ($deleteSql) {
	header('Location: view-jadwal-kbm.php');
}
?>