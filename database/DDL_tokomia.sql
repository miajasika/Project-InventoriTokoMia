CREATE DATABASE IF NOT EXISTS db_TokoMia;
USE db_TokoMia;

CREATE TABLE `role` (
idrole INT NOT NULL AUTO_INCREMENT,
nama_role VARCHAR(100) NOT NULL,
CONSTRAINT pk_role PRIMARY KEY (idrole)
) ENGINE=InnoDB;

CREATE TABLE satuan (
idsatuan INT NOT NULL AUTO_INCREMENT,
nama_satuan VARCHAR(45) NOT NULL,
status_satuan TINYINT NOT NULL DEFAULT 1,
CONSTRAINT pk_satuan PRIMARY KEY (idsatuan)
) ENGINE=InnoDB;

CREATE TABLE vendor (
idvendor INT NOT NULL AUTO_INCREMENT,
nama_vendor VARCHAR(100) NOT NULL,
badan_hukum CHAR(1) NOT NULL,
status_vendor CHAR(1) NOT NULL,
CONSTRAINT pk_vendor PRIMARY KEY (idvendor)
) ENGINE=InnoDB;

CREATE TABLE user (
iduser INT NOT NULL AUTO_INCREMENT,
username VARCHAR(45) NOT NULL,
password_user VARCHAR(100) NOT NULL,
idrole INT NOT NULL,
CONSTRAINT pk_user PRIMARY KEY (iduser),
CONSTRAINT uq_user_username UNIQUE (username),
CONSTRAINT fk_user_role FOREIGN KEY (idrole) REFERENCES role (idrole) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE margin_penjualan (
idmargin_penjualan INT NOT NULL AUTO_INCREMENT,
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
persen DOUBLE NOT NULL,
status_margin TINYINT NOT NULL DEFAULT 1,
iduser INT NOT NULL,
updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT pk_margin_penjualan PRIMARY KEY (idmargin_penjualan),
CONSTRAINT fk_margin_user FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE barang (
idbarang INT NOT NULL AUTO_INCREMENT,
jenis CHAR(1) NOT NULL,
nama VARCHAR(45) NOT NULL,
idsatuan INT NOT NULL,
status TINYINT NOT NULL DEFAULT 1,
harga INT NOT NULL,
CONSTRAINT pk_barang PRIMARY KEY (idbarang),
CONSTRAINT fk_barang_satuan FOREIGN KEY (idsatuan) REFERENCES satuan (idsatuan) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pengadaan (
idpengadaan BIGINT NOT NULL AUTO_INCREMENT,
timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
user_iduser INT NOT NULL,
status_pengadaan CHAR(1) NOT NULL,
vendor_idvendor INT NOT NULL,
subtotal_nilai INT NOT NULL DEFAULT 0,
ppn INT NOT NULL DEFAULT 0,
total_nilai INT NOT NULL DEFAULT 0,
CONSTRAINT pk_pengadaan PRIMARY KEY (idpengadaan),
CONSTRAINT fk_pengadaan_user FOREIGN KEY (user_iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_pengadaan_vendor FOREIGN KEY (vendor_idvendor) REFERENCES vendor (idvendor) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE detail_pengadaan (
iddetail_pengadaan BIGINT NOT NULL AUTO_INCREMENT,
harga_satuan INT NOT NULL,
jumlah INT NOT NULL,
sub_total INT NOT NULL,
idbarang INT NOT NULL,
idpengadaan BIGINT NOT NULL,
CONSTRAINT pk_detail_pengadaan PRIMARY KEY (iddetail_pengadaan),
CONSTRAINT fk_dpengadaan_barang FOREIGN KEY (idbarang) REFERENCES barang (idbarang) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_dpengadaan_pengadaan FOREIGN KEY (idpengadaan) REFERENCES pengadaan (idpengadaan) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE penerimaan (
idpenerimaan BIGINT NOT NULL AUTO_INCREMENT,
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
status_penerimaan CHAR(1) NOT NULL,
idpengadaan BIGINT NOT NULL,
iduser INT NOT NULL,
CONSTRAINT pk_penerimaan PRIMARY KEY (idpenerimaan),
CONSTRAINT fk_penerimaan_pengadaan FOREIGN KEY (idpengadaan) REFERENCES pengadaan (idpengadaan) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_penerimaan_user FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE detail_penerimaan (
iddetail_penerimaan BIGINT NOT NULL AUTO_INCREMENT,
idpenerimaan BIGINT NOT NULL,
barang_idbarang INT NOT NULL,
jumlah_terima INT NOT NULL,
harga_satuan_terima INT NOT NULL,
sub_total_terima INT NOT NULL,
CONSTRAINT pk_detail_penerimaan PRIMARY KEY (iddetail_penerimaan),
CONSTRAINT fk_dpenerimaan_penerimaan FOREIGN KEY (idpenerimaan) REFERENCES penerimaan (idpenerimaan) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_dpenerimaan_barang FOREIGN KEY (barang_idbarang) REFERENCES barang (idbarang) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE retur (
idretur BIGINT NOT NULL AUTO_INCREMENT,
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
idpenerimaan BIGINT NOT NULL,
iduser INT NOT NULL,
CONSTRAINT pk_retur PRIMARY KEY (idretur),
CONSTRAINT fk_retur_penerimaan FOREIGN KEY (idpenerimaan) REFERENCES penerimaan (idpenerimaan) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_retur_user FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE detail_retur (
iddetail_retur INT NOT NULL AUTO_INCREMENT,
jumlah INT NOT NULL,
alasan VARCHAR(200) NOT NULL,
idretur BIGINT NOT NULL,
iddetail_penerimaan BIGINT NOT NULL,
CONSTRAINT pk_detail_retur PRIMARY KEY (iddetail_retur),
CONSTRAINT fk_dretur_retur FOREIGN KEY (idretur) REFERENCES retur (idretur) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_dretur_dpenerimaan FOREIGN KEY (iddetail_penerimaan) REFERENCES detail_penerimaan (iddetail_penerimaan) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE penjualan (
idpenjualan INT NOT NULL AUTO_INCREMENT,
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
subtotal_nilai INT NOT NULL DEFAULT 0,
ppn INT NOT NULL DEFAULT 0,
total_nilai INT NOT NULL DEFAULT 0,
iduser INT NOT NULL,
idmargin_penjualan INT NOT NULL,
CONSTRAINT pk_penjualan PRIMARY KEY (idpenjualan),
CONSTRAINT fk_penjualan_user FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_penjualan_margin FOREIGN KEY (idmargin_penjualan) REFERENCES margin_penjualan (idmargin_penjualan) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE detail_penjualan (
iddetail_penjualan BIGINT NOT NULL AUTO_INCREMENT,
harga_satuan INT NOT NULL,
jumlah INT NOT NULL,
subtotal INT NOT NULL,
penjualan_idpenjualan INT NOT NULL,
idbarang INT NOT NULL,
CONSTRAINT pk_detail_penjualan PRIMARY KEY (iddetail_penjualan),
CONSTRAINT fk_dpenjualan_penjualan FOREIGN KEY (penjualan_idpenjualan) REFERENCES penjualan (idpenjualan) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT fk_dpenjualan_barang FOREIGN KEY (idbarang) REFERENCES barang (idbarang) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE kartu_stok (
idkartu_stok BIGINT NOT NULL AUTO_INCREMENT,
jenis_transaksi CHAR(1) NOT NULL,
masuk INT NOT NULL DEFAULT 0,
keluar INT NOT NULL DEFAULT 0,
stock INT NOT NULL DEFAULT 0,
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
idtransaksi INT NOT NULL,
idbarang INT NOT NULL,
CONSTRAINT pk_kartu_stok PRIMARY KEY (idkartu_stok),
CONSTRAINT fk_kartu_barang FOREIGN KEY (idbarang) REFERENCES barang (idbarang) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB;
