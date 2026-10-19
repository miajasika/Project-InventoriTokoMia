<?php
include 'config/koneksi.php';

$query = "SELECT * FROM satuan ORDER BY idsatuan ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Project Inventori TokoMia</title>
</head>
<body>

    <h1>Sistem Inventori Toko Mia</h1>
    <hr>

    <h3> Master Data</h3>
    <ul>
        <li><a href="satuan.php">Master Satuan</a></li>
        <li><a href="barang.php">Master Barang</a></li>
        <li><a href="vendor.php">Master Vendor</a></li>
        <li><a href="user.php">Master User</a></li>
        <li><a href="role.php">Master Role</a></li>
                           
        
    </ul>

    <h3> Laporan</h3>
    <ul>
        <li><a href="lap.view/satuan_vu.php">Laporan Satuan </a></li>
        <li><a href="lap.view/barang_vu.php">Laporan Barang </a></li>
        <li><a href="lap.view/vendor_vu.php">Laporan Vendor </a></li>
        <li><a href="lap.view/role_vu.php">Laporan Role </a></li>
        <li><a href="lap.view/user_vu.php">Laporan User </a></li>
    </ul>

</body>
</html>