<?php
include "config/koneksi.php";
$edit_data = null;

if (isset($_GET['edit'])) {
    $id_edit = intval($_GET['edit']);
    $query_edit = mysqli_query($koneksi, "SELECT * FROM role WHERE idrole = $id_edit");
    $edit_data = mysqli_fetch_assoc($query_edit);
}

$result = mysqli_query($koneksi, "SELECT * FROM role");

if (isset($_POST['tambah'])) {
    $nama_role = mysqli_real_escape_string($koneksi, $_POST['nama_role']);

    $query = "INSERT INTO role (nama_role) VALUES ('$nama_role')";
    mysqli_query($koneksi, $query);
    header("Location: role.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['idrole']);
    $nama_role = mysqli_real_escape_string($koneksi, $_POST['nama_role']);

    $query = "UPDATE role SET nama_role='$nama_role' WHERE idrole=$id";
    mysqli_query($koneksi, $query);
    header("Location: role.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "DELETE FROM role WHERE idrole=$id";
    mysqli_query($koneksi, $query);
    header("Location: role.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
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
                <li><a href="role.php">Role</a></li>
                <li><a href="user.php">User</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Data Role</h1>
            <div class="container">
                <form action="" method="POST">
                    <h3><?php echo $edit_data ? 'Edit Role' : 'Tambah Role'; ?></h3>
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="idrole" value="<?php echo $edit_data['idrole']; ?>">
                    <?php endif; ?>
                    
                    <div class="input-group">
                        <label>Nama Role:</label>
                        <input type="text" name="nama_role" value="<?php echo $edit_data ? htmlspecialchars($edit_data['nama_role']) : ''; ?>" required>
                    </div>

                    <?php if ($edit_data): ?>
                        <button type="submit" name="update">Simpan Perubahan</button>
                        <a href="role.php">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah">Tambah Role</button>
                    <?php endif; ?>
                </form>
            </div>

            <table class="data-table" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Role</th>
                        <th>Nama Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['idrole']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_role']); ?></td>
                            <td>
                                <a href="?edit=<?php echo $row['idrole']; ?>">Edit</a> |
                                <a href="?hapus=<?php echo $row['idrole']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>