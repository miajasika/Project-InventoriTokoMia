USE db_TokoMia;

-- 1. satuan_vu
CREATE OR REPLACE VIEW satuan_vu AS
SELECT s.idsatuan AS Jenis_Satuan,
s.nama_satuan AS Nama_Satuan,
s.status_satuan AS Status
FROM satuan s;

-- 2. vendor_vu
CREATE OR REPLACE VIEW vendor_vu AS
SELECT 
v.idvendor,
v.nama_vendor,
v.badan_hukum,
v.status_vendor
FROM vendor v;

-- 3. role_vu
CREATE OR REPLACE VIEW role_vu AS
SELECT 
r.idrole AS Jenis_Role,
r.nama_role AS Nama_Role
FROM role r;

-- 4. margin_vu
CREATE OR REPLACE VIEW margin_vu AS
SELECT
mp.idmargin_penjualan AS No_Penjualan,
mp.persen AS Persen,
mp.status_margin AS Status
FROM margin_penjualan mp;

-- 5. barang_vu
CREATE OR REPLACE VIEW barang_vu AS
SELECT b.idbarang AS No_Barang,
b.nama AS Nama,
b.`status` AS Status
FROM barang b
JOIN satuan s ON s.idsatuan = b.idsatuan;

-- 6. user_vu
CREATE OR REPLACE VIEW user_vu AS
SELECT u.iduser AS Id_Pengguna,
u.username AS Username,
r.nama_role AS Role
FROM user u
JOIN role r ON r.idrole = u.idrole;

