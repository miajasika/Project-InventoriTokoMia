<?php
include "config/koneksi.php";
$edit_data = null;

if (isset($_GET['edit'])) {
    $id_edit = intval($_GET['edit']);
    $query_edit = mysqli_query($koneksi, "SELECT * FROM barang WHERE idbarang = $id_edit");
    $edit_data = mysqli_fetch_assoc($query_edit);
}

$result = mysqli_query($koneksi, "SELECT b.*, s.nama_satuan FROM barang b LEFT JOIN satuan s ON b.idsatuan = s.idsatuan");
$data_satuan = mysqli_query($koneksi, "SELECT * FROM satuan");

if (isset($_POST['tambah'])) {$nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $idsatuan = intval($_POST['idsatuan']);
    $status = intval($_POST['status']);

    $query = "INSERT INTO barang (nama, idsatuan, `status`) VALUES ('$nama', $idsatuan,$status)";
    mysqli_query($koneksi,$query);
    header("Location: barang.php");
    exit();
}

if (isset($_POST['update'])) {$id = intval($_POST['idbarang']);$nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $idsatuan = intval($_POST['idsatuan']);
    $status = intval($_POST['status']);

    $query = "UPDATE barang SET nama='$nama', idsatuan=$idsatuan, `status`=$status WHERE idbarang=$id";
    mysqli_query($koneksi,$query);
    header("Location: barang.php");
    exit();
}

if (isset($_GET['hapus'])) {$id = intval($_GET['hapus']);$query = "DELETE FROM barang WHERE idbarang=$id";
    mysqli_query($koneksi,$query);
    header("Location: barang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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
            <h1>Data Barang</h1>
            <div class="container">
                <form action="" method="POST">
                    <h3><?php echo $edit_data ? 'Edit Barang' : 'Tambah Barang'; ?></h3>
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="idbarang" value="<?php echo $edit_data['idbarang']; ?>">
                    <?php endif; ?>
                    
                    <div class="input-group">
                        <label>Nama Barang:</label>
                        <input type="text" name="nama" value="<?php echo $edit_data ? htmlspecialchars($edit_data['nama']) : ''; ?>" required>
                    </div>

                    <div class="input-group">
                        <label>Satuan:</label>
                        <select name="idsatuan" required>
                            <option value="">-- Pilih Satuan --</option>
                            <?php while ($sat = mysqli_fetch_assoc($data_satuan)): ?>
                                <option value="<?php echo $sat['idsatuan']; ?>" <?php echo $edit_data && $edit_data['idsatuan'] ==$sat['idsatuan'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($sat['nama_satuan']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label>Status:</label>
                        <select name="status" required>
                            <option value="1" <?php echo $edit_data &&$edit_data['status'] == 1 ? 'selected' : ''; ?>>1 - Aktif</option>
                            <option value="0" <?php echo $edit_data &&$edit_data['status'] == 0 ? 'selected' : ''; ?>>0 - Non-Aktif</option>
                        </select>
                    </div>

                    <?php if ($edit_data): ?>
                        <button type="submit" name="update">Simpan Perubahan</button> 
                        <a href="barang.php">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah">Tambah Barang</button>
                    <?php endif; ?>
                </form>
            </div>

            <table class="data-table" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['idbarang']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_satuan']); ?></td>
                            <td><?php echo $row['status'] == 1 ? 'Aktif' : 'Non-Aktif'; ?></td>
                            <td>
                                <a href="?edit=<?php echo $row['idbarang']; ?>">Edit</a> |
                                <a href="?hapus=<?php echo $row['idbarang']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>