<?php
include("koneksi.php");
?>
<html>
    <head>
        <title>Print</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <?php
        if (isset($_GET['table']) && $_GET['table'] == 'murid' && isset($_GET['id'])) {
        ?>
            <center><h1>Jadwal Murid</h1></center><br/>
            <table border='0'>
        <?php
            $sql = mysqli_query($db, "SELECT * FROM `murid` WHERE idMurid = '$_GET[id]'");
            if (mysqli_num_rows($sql) > 0) {
                while ($data = mysqli_fetch_array($sql)) {
                    $paketMurid = str_replace(", ", "|", $data['paket']);
                    $kelasMurid = $data['kelas'];
                    $namaMurid = $data['namaMurid'];
        ?>
                <tr><td>ID Murid</td><td>: <?= $data['idMurid']; ?></td></tr>
                <tr><td>Nama Murid</td><td>: <?= $data['namaMurid']; ?></td></tr>
                <tr><td>Jenis Paket</td><td>: <?= $data['paket']; ?></td></tr>
                <tr><td>Kelas</td><td>: <?= $data['kelas']; ?></td></tr>
        <?php
                }
            }
            echo "</table><br/>";
        ?>
        <table width="100%" border="1" cellspacing="0">
            <tr>
                <th>ID Murid</th>
                <th>Nama Murid</th>
                <th>Kelas</th>
                <th>Paket</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Tentor</th>
            </tr>
            <?php
            $dataJadwal = mysqli_query($db, "SELECT murid.idMurid, murid.namaMurid, murid.kelas, kbm.paket, kbm.hariMengajar, kbm.jamMulai, kbm.jamAkhir, tentor.namaTentor from kbm, murid, tentor where kbm.kelas = '$kelasMurid' AND kbm.paket REGEXP '$paketMurid' AND tentor.idTentor = kbm.tentor AND murid.namaMurid = '$namaMurid'");
            if (mysqli_num_rows($dataJadwal) > 0) {
                while ($dJadwal = mysqli_fetch_array($dataJadwal)) {
            ?>
            <tr>
                <td><?php echo $dJadwal['idMurid'];?></td>
                <td><?php echo $dJadwal['namaMurid'];?></td>
                <td><?php echo $dJadwal['kelas'];?></td>
                <td><?php echo $dJadwal['paket'];?></td>
                <td><?php echo $dJadwal['hariMengajar'];?></td>
                <td><?php echo $dJadwal['jamMulai'] . "-" . $dJadwal['jamAkhir'];?></td>
                <td><?php echo $dJadwal['namaTentor'];?></td>
            </tr>
        <?php
                }
            }
            echo "</table>";
            echo "<script>window.print(); </script>";
        }
        else if (isset($_GET['table']) && $_GET['table'] == 'tentor' && isset($_GET['id'])) {
        ?>
            <center><h1>Jadwal Tentor</h1></center><br/>
            <table border='0'>
            <?php
                $sql = mysqli_query($db, "SELECT * FROM `tentor` WHERE idTentor = '$_GET[id]'");
                if (mysqli_num_rows($sql) > 0) {
                    while ($data = mysqli_fetch_array($sql)) {
            ?>
                    <tr><td>ID Tentor</td><td>: <?= $data['idTentor']; ?></td></tr>
                    <tr><td>Nama Tentor</td><td>: <?= $data['namaTentor']; ?></td></tr>
                    <tr><td>Jenis Paket</td><td>: <?= $data['paket']; ?></td></tr>
                    <tr><td>Tingkat</td><td>: <?= $data['tingkat']; ?></td></tr>
            <?php
                    }
                }
                echo "</table><br/>";
            ?>
            <table width="100%" border="1" cellspacing="0">
                <tr>
                    <th>ID Tentor</th>
                    <th>Nama Tentor</th>
                    <th>Tingkat</th>
                    <th>Paket</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
                <?php
                $dataJadwal = mysqli_query($db, "SELECT kbm.*, tentor.namaTentor FROM `kbm`, `tentor` WHERE kbm.tentor = '$_GET[id]' AND kbm.tentor = tentor.idTentor");
                if (mysqli_num_rows($dataJadwal) > 0) {
                    while ($dJadwal = mysqli_fetch_array($dataJadwal)) {
                ?>
                <tr>
                    <td><?php echo $dJadwal['tentor'];?></td>
                    <td><?php echo $dJadwal['namaTentor'];?></td>
                    <td><?php echo $dJadwal['tingkat'];?></td>
                    <td><?php echo $dJadwal['paket'];?></td>
                    <td><?php echo $dJadwal['hariMengajar'];?></td>
                    <td><?php echo $dJadwal['jamMulai'] . "-" . $dJadwal['jamAkhir'];?></td>
                </tr>
            <?php
                    }
                }
                echo "</table>";
                echo "<script>window.print(); </script>";
            }
            ?>
    </body>
</html>