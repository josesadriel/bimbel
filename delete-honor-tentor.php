<?php
include('koneksi.php');
if (isset($_GET['id'])) {
    $deleteSql = mysqli_query($db, "DELETE FROM `honor_tentor` WHERE id = '$_GET[id]'");
    if ($deleteSql) header('Location: honor-tentor.php');
}