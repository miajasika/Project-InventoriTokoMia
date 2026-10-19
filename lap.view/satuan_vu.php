<?php
include '../config/koneksi.php';

$query = "SELECT * FROM satuan_vu";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Satuan</title>
</head>
<body>

    <a href="../index.php"> Kembali</a> 

    <h2>Laporan Data Satuan (VIEW)</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Jenis Satuan (ID)</th>
                <th>Nama Satuan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['Jenis_Satuan']); ?></td>
                <td><?= htmlspecialchars($row['Nama_Satuan']); ?></td>
                <td><?= htmlspecialchars($row['Status']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>