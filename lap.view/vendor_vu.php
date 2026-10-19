<?php
include '../config/koneksi.php';
$query = "SELECT * FROM vendor_vu";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Vendor View</title>
</head>
<body>
    <a href="../index.php"> Kembali</a> 
    <h2>Laporan Data Vendor (VIEW)</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Vendor</th>
                <th>Nama Vendor</th>
                <th>Badan Hukum</th>
                <th>Status Vendor</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['idvendor'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['nama_vendor'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['badan_hukum'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['status_vendor'] ?? ''); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>