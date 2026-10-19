<?php
include "config/koneksi.php";
$edit_data = null;

if (isset($_GET['edit'])) {
    $id_edit = intval($_GET['edit']);
    $query_edit = mysqli_query($koneksi, "SELECT * FROM vendor WHERE idvendor = $id_edit");
    $edit_data = mysqli_fetch_assoc($query_edit);
}

$result = mysqli_query($koneksi, "SELECT * FROM vendor");

if (isset($_POST['tambah'])) {
    $nama_vendor = mysqli_real_escape_string($koneksi, $_POST['nama_vendor']);
    $badan_hukum = mysqli_real_escape_string($koneksi, $_POST['badan_hukum']);
    $status = intval($_POST['status_vendor']);

    $query = "INSERT INTO vendor (nama_vendor, badan_hukum, status_vendor) VALUES ('$nama_vendor', '$badan_hukum', $status)";
    mysqli_query($koneksi, $query);
    header("Location: vendor.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['idvendor']);
    $nama_vendor = mysqli_real_escape_string($koneksi, $_POST['nama_vendor']);
    $badan_hukum = mysqli_real_escape_string($koneksi, $_POST['badan_hukum']);
    $status = intval($_POST['status_vendor']);

    $query = "UPDATE vendor SET nama_vendor='$nama_vendor', badan_hukum='$badan_hukum', status_vendor=$status WHERE idvendor=$id";
    mysqli_query($koneksi, $query);
    header("Location: vendor.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "DELETE FROM vendor WHERE idvendor=$id";
    mysqli_query($koneksi, $query);
    header("Location: vendor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Vendor</title>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar">
            <h2>TokoMia</h2>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="satuan.php">Satuan</a></li>
                <li><a href="vendor.php">Vendor</a></li>
                <li><a href="barang.php">Barang</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Data Vendor</h1>
            <div class="container">
                <form action="" method="POST">
                    <h3><?php echo $edit_data ? 'Edit Vendor' : 'Tambah Vendor'; ?></h3>
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="idvendor" value="<?php echo $edit_data['idvendor']; ?>">
                    <?php endif; ?>
                    
                    <div class="input-group">
                        <label>Nama Vendor:</label>
                        <input type="text" name="nama_vendor" value="<?php echo $edit_data ? htmlspecialchars($edit_data['nama_vendor']) : ''; ?>" required>
                    </div>

                    <div class="input-group">
                        <label>Badan Hukum:</label>
                        <input type="text" name="badan_hukum" value="<?php echo $edit_data ? htmlspecialchars($edit_data['badan_hukum']) : ''; ?>" required>
                    </div>

                    <div class="input-group">
                        <label>Status:</label>
                        <select name="status_vendor" required>
                            <option value="1" <?php echo $edit_data && $edit_data['status_vendor'] == 1 ? 'selected' : ''; ?>>1 - Aktif</option>
                            <option value="0" <?php echo $edit_data && $edit_data['status_vendor'] == 0 ? 'selected' : ''; ?>>0 - Non-Aktif</option>
                        </select>
                    </div>

                    <?php if ($edit_data): ?>
                        <button type="submit" name="update">Simpan Perubahan</button> 
                        <a href="vendor.php">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah">Tambah Vendor</button>
                    <?php endif; ?>
                </form>
            </div>

            <table class="data-table" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Vendor</th>
                        <th>Nama Vendor</th>
                        <th>Badan Hukum</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['idvendor']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_vendor']); ?></td>
                            <td><?php echo htmlspecialchars($row['badan_hukum']); ?></td>
                            <td><?php echo $row['status_vendor'] == 1 ? 'Aktif' : 'Non-Aktif'; ?></td>
                            <td>
                                <a href="?edit=<?php echo $row['idvendor']; ?>">Edit</a> |
                                <a href="?hapus=<?php echo $row['idvendor']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>