<?php
include '../config/koneksi.php';

$query = "SELECT * FROM user_vu";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan User View</title>
</head>
<body>

    <a href="../index.php"> Kembali</a> 

    <h2>Laporan Data User (VIEW)</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Pengguna</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= htmlspecialchars($row['Id_Pengguna'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['Username'] ?? ''); ?></td>
                <td><?= htmlspecialchars($row['Role'] ?? ''); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>