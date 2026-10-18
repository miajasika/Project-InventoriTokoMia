<?php
include 'config/koneksi.php';

$query = "SELECT * FROM satuan ORDER BY idsatuan ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Satuan Barang - TokoMia</title>
</head>
<body>

    <h2>Daftar Satuan Barang - TokoMia</h2>
    <a href="tambah.php">+ Tambah Satuan Baru</a><br><br>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>No / ID</th>
                <th>Nama Satuan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['idsatuan']; ?></td>
                <td><?= htmlspecialchars($row['nama_satuan']); ?></td>
                <td><?= ($row['status_satuan'] == 1) ? 'Aktif' : 'Non-Aktif'; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['idsatuan']; ?>">Edit</a> | 
                    <a href="hapus.php?id=<?= $row['idsatuan']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>