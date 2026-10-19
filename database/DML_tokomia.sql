USE db_TokoMia;

INSERT INTO `role` (nama_role) 
VALUES
('Admin'),
('Staff Gudang'),
('Kasir'),
('Manager'),
('Supervisor');

INSERT INTO satuan (nama_satuan, status_satuan) 
VALUES
('Pcs', 1),
('Box', 1),
('Kg', 1),
('Liter', 1),
('Pack', 1);

INSERT INTO vendor (nama_vendor, badan_hukum, status_vendor) 
VALUES
('PT Sumber Makmur', 'P', 'A'),
('CV Berkah Jaya', 'C', 'A'),
('UD Sejahtera', 'U', 'A'),
('PT Maju Bersama', 'P', 'A'),
('CV Cahaya Abadi', 'C', 'A');

INSERT INTO `user` (username, password_user, idrole) 
VALUES
('admin', 'admin123', 1),
('gudang', 'gudang123', 2),
('kasir', 'kasir123', 3),
('manager', 'manager123', 4),
('supervisor', 'supervisor123', 5);

INSERT INTO margin_penjualan (persen, status_margin, iduser) 
VALUES
(10, 0, 1),
(15, 1, 1),
(20, 1, 4),
(12, 1, 5),
(18, 1, 3);

INSERT INTO barang (jenis, nama, idsatuan, status, harga) 
VALUES
('B', 'Pensil 2B', 1, 1, 2000),
('B', 'Buku Tulis', 2, 1, 5000),
('B', 'Gula Pasir', 3, 1, 12000),
('B', 'Minyak Goreng', 4, 1, 15000),
('B', 'Sabun Mandi', 5, 1, 3000);
