<?php
include 'config/koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM satuan WHERE idsatuan = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_satuan   = $_POST['nama_satuan'];
    $status_satuan = $_POST['status_satuan'];

    $query_update = "UPDATE satuan SET nama_satuan = '$nama_satuan', status_satuan = '$status_satuan' WHERE idsatuan = '$id'";
    if (mysqli_query($koneksi, $query_update)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Satuan</title>
</head>
<body>

    <h2>Edit Data Satuan</h2>

    <form action="" method="POST">
        <p>
            <label>ID Satuan:</label><br>
            <input type="text" value="<?= $data['idsatuan']; ?>" disabled>
        </p>
        <p>
            <label>Nama Satuan:</label><br>
            <input type="text" name="nama_satuan" value="<?= htmlspecialchars($data['nama_satuan']); ?>" required>
        </p>
        <p>
            <label>Status:</label><br>
            <select name="status_satuan" required>
                <option value="1" <?= ($data['status_satuan'] == 1) ? 'selected' : ''; ?>>1 - Aktif</option>
                <option value="0" <?= ($data['status_satuan'] == 0) ? 'selected' : ''; ?>>0 - Non-Aktif</option>
            </select>
        </p>
        <p>
            <button type="submit" name="update">Simpan Perubahan</button>
            <a href="index.php">Batal</a>
        </p>
    </form>

</body>
</html>