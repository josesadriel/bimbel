<?php
include('koneksi.php');
if (isset($_GET['id'])) {
    $deleteSql = mysqli_query($db, "DELETE FROM `biaya_bimbingan` WHERE id = '$_GET[id]'");
    if ($deleteSql) header('Location: biaya-bimbingan.php');
}