<?php
include '../config/koneksi.php';

$query = "SELECT * FROM barang_vu";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Barang View</title>
</head>
<body>

    <a href="../index.php"> Kembali</a> 

    <h2>Laporan Data Barang (VIEW)</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No / Kode Barang</th>
                <th>Nama Barang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['No_Barang'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['Nama'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['Status'] ?? ''); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>