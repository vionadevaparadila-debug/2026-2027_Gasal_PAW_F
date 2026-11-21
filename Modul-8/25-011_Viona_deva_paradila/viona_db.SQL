CREATE DATABASE IF NOT EXISTS penjualan;

USE penjualan;

CREATE TABLE supplier (
        id INT NOT NULL AUTO_INCREMENT,
        nama VARCHAR(100) NOT NULL,
        telp VARCHAR(12),
        alamat TEXT,
        PRIMARY KEY (id)
    );

CREATE TABLE barang (
        id INT NOT NULL AUTO_INCREMENT,
        kode_barang VARCHAR(10) NOT NULL,
        nama_barang VARCHAR(100) NOT NULL,
        harga INT NOT NULL,
        stok INT NOT NULL,
        supplier_id INT NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY uk_kode_barang (kode_barang),
        KEY idx_barang_supplier (supplier_id),
        CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE pelanggan (
        id VARCHAR(20) NOT NULL,
        nama VARCHAR(100) NOT NULL,
        jenis_kelamin ENUM ('L', 'P') NOT NULL,
        telp VARCHAR(12),
        alamat TEXT,
        PRIMARY KEY (id)
    );

CREATE TABLE transaksi (
        id INT NOT NULL AUTO_INCREMENT,
        waktu_transaksi DATE NOT NULL,
        keterangan TEXT,
        total INT NOT NULL,
        pelanggan_id VARCHAR(20) NOT NULL,
        PRIMARY KEY (id),
        KEY idx_transaksi_pelanggan (pelanggan_id),
        CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE transaksi_detail (
        transaksi_id INT NOT NULL,
        barang_id INT NOT NULL,
        harga INT NOT NULL,
        qty INT NOT NULL,
        PRIMARY KEY (transaksi_id, barang_id),
        KEY idx_detail_barang (barang_id),
        CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id) ON UPDATE CASCADE ON DELETE CASCADE,
        CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id) REFERENCES barang (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE pembayaran (
        id INT NOT NULL AUTO_INCREMENT,
        waktu_bayar DATETIME NOT NULL,
        total INT NOT NULL,
        metode ENUM ('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
        transaksi_id INT NOT NULL,
        PRIMARY KEY (id),
        KEY idx_pembayaran_transaksi (transaksi_id),
        CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id) ON UPDATE CASCADE ON DELETE CASCADE
    );

CREATE TABLE users (
        id_user TINYINT NOT NULL AUTO_INCREMENT,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(35) NOT NULL,
        nama VARCHAR(50) NOT NULL,
        alamat VARCHAR(150),
        hp VARCHAR(20),
        level TINYINT (1) NOT NULL,
        PRIMARY KEY (id_user),
        UNIQUE KEY uk_username (username)
    );