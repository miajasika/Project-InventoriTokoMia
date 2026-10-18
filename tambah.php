<?php
include 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_satuan   = $_POST['nama_satuan'];
    $status_satuan = $_POST['status_satuan'];

    $query = "INSERT INTO satuan (nama_satuan, status_satuan) VALUES ('$nama_satuan', '$status_satuan')";
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Satuan Baru</title>
</head>
<body>

    <h2>Tambah Satuan Baru</h2>

    <form action="" method="POST">
        <p>
            <label>Nama Satuan:</label><br>
            <input type="text" name="nama_satuan" required>
        </p>
        <p>
            <label>Status:</label><br>
            <select name="status_satuan" required>
                <option value="1">1 - Aktif</option>
                <option value="0">0 - Non-Aktif</option>
            </select>
        </p>
        <p>
            <button type="submit" name="simpan">Simpan Data</button>
            <a href="index.php">Batal</a>
        </p>
    </form>

</body>
</html>