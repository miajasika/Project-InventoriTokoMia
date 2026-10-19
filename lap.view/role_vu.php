<?php
include '../config/koneksi.php';

$query = "SELECT * FROM role_vu";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Role View</title>
</head>
<body>

    <a href="../index.php"> Kembali</a> 

    <h2>Laporan Data Role (VIEW)</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Jenis Role</th>
                <th>Nama Role</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['Jenis_Role'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['Nama_Role'] ?? ''); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>