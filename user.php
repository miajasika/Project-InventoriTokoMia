<?php
include "config/koneksi.php";
$edit_data = null;

if (isset($_GET['edit'])) {
    $id_edit = intval($_GET['edit']);
    $query_edit = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = $id_edit");
    $edit_data = mysqli_fetch_assoc($query_edit);
}

$result = mysqli_query($koneksi, "SELECT u.*, r.nama_role FROM user u LEFT JOIN role r ON u.idrole = r.idrole");
$data_role = mysqli_query($koneksi, "SELECT * FROM role");

if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $idrole = intval($_POST['idrole']);

    $query = "INSERT INTO user (username, password, idrole) VALUES ('$username', '$password', $idrole)";
    mysqli_query($koneksi, $query);
    header("Location: user.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = intval($_POST['iduser']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $idrole = intval($_POST['idrole']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE user SET username='$username', password='$password', idrole=$idrole WHERE iduser=$id";
    } else {
        $query = "UPDATE user SET username='$username', idrole=$idrole WHERE iduser=$id";
    }

    mysqli_query($koneksi, $query);
    header("Location: user.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "DELETE FROM user WHERE iduser=$id";
    mysqli_query($koneksi, $query);
    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
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
            <h1>Data User</h1>
            <div class="container">
                <form action="" method="POST">
                    <h3><?php echo $edit_data ? 'Edit User' : 'Tambah User'; ?></h3>
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="iduser" value="<?php echo $edit_data['iduser']; ?>">
                    <?php endif; ?>
                    
                    <div class="input-group">
                        <label>Username:</label>
                        <input type="text" name="username" value="<?php echo $edit_data ? htmlspecialchars($edit_data['username']) : ''; ?>" required>
                    </div>

                    <div class="input-group">
                        <label>Password: <?php echo $edit_data ? '<small>(Kosongkan jika tidak diubah)</small>' : ''; ?></label>
                        <input type="password" name="password" <?php echo $edit_data ? '' : 'required'; ?>>
                    </div>

                    <div class="input-group">
                        <label>Role:</label>
                        <select name="idrole" required>
                            <option value="">-- Pilih Role --</option>
                            <?php while ($r = mysqli_fetch_assoc($data_role)): ?>
                                <option value="<?php echo $r['idrole']; ?>" <?php echo $edit_data && $edit_data['idrole'] == $r['idrole'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($r['nama_role']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <?php if ($edit_data): ?>
                        <button type="submit" name="update">Simpan Perubahan</button>
                        <a href="user.php">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah">Tambah User</button>
                    <?php endif; ?>
                </form>
            </div>

            <table class="data-table" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['iduser']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_role']); ?></td>
                            <td>
                                <a href="?edit=<?php echo $row['iduser']; ?>">Edit</a> |
                                <a href="?hapus=<?php echo $row['iduser']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>