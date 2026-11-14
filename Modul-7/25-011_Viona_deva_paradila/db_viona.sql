CREATE DATABASE IF NOT EXISTS penjualan;

USE penjualan;

-- Tabel supplier
CREATE TABLE
    supplier (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        telp VARCHAR(12),
        alamat TEXT
    ) ENGINE = InnoDB;

-- Tabel barang
CREATE TABLE
    barang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        kode_barang VARCHAR(10) NOT NULL UNIQUE,
        nama_barang VARCHAR(100) NOT NULL,
        harga INT NOT NULL,
        stok INT NOT NULL DEFAULT 0,
        supplier_id INT,
        CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON UPDATE CASCADE ON DELETE SET NULL
    ) ENGINE = InnoDB;

-- Tabel pelanggan
CREATE TABLE
    pelanggan (
        id VARCHAR(20) PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        jenis_kelamin ENUM ('L', 'P') NOT NULL,
        telp VARCHAR(12),
        alamat TEXT
    ) ENGINE = InnoDB;

-- Tabel transaksi
CREATE TABLE
    transaksi (
        id INT AUTO_INCREMENT PRIMARY KEY,
        waktu_transaksi DATE NOT NULL,
        keterangan TEXT,
        total INT NOT NULL DEFAULT 0,
        pelanggan_id VARCHAR(20),
        CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan (id) ON UPDATE CASCADE ON DELETE SET NULL
    ) ENGINE = InnoDB;

-- Tabel transaksi_detail
CREATE TABLE
    transaksi_detail (
        transaksi_id INT NOT NULL,
        barang_id INT NOT NULL,
        harga INT NOT NULL,
        qty INT NOT NULL,
        PRIMARY KEY (transaksi_id, barang_id),
        CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id) ON UPDATE CASCADE ON DELETE CASCADE,
        CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id) REFERENCES barang (id) ON UPDATE CASCADE ON DELETE RESTRICT
    ) ENGINE = InnoDB;

-- Tabel pembayaran
CREATE TABLE
    pembayaran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        waktu_bayar DATETIME NOT NULL,
        total INT NOT NULL,
        metode ENUM ('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
        transaksi_id INT NOT NULL,
        CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE = InnoDB;

-- Tabel user
CREATE TABLE
    users (
        id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(35) NOT NULL,
        nama VARCHAR(50) NOT NULL,
        alamat VARCHAR(150),
        hp VARCHAR(20),
        level TINYINT (1) NOT NULL DEFAULT 0
    ) ENGINE = InnoDB;

USE penjualan;

-- Data supplier
INSERT INTO
    supplier (nama, telp, alamat)
VALUES
    (
        'PT Sumber Makmur',
        '031555101',
        'Jl. Rungkut Industri No. 12, Surabaya'
    ),
    (
        'CV Maju Jaya',
        '031555202',
        'Jl. Darmo Permai No. 45, Surabaya'
    ),
    (
        'UD Berkah Abadi',
        '035155303',
        'Jl. Raya Gresik No. 8, Gresik'
    ),
    (
        'PT Nusantara Distribusi',
        '031555404',
        'Jl. Ahmad Yani No. 101, Surabaya'
    ),
    (
        'CV Sinar Terang',
        '034355505',
        'Jl. Pahlawan No. 77, Sidoarjo'
    );

-- Data barang
INSERT INTO
    barang (
        kode_barang,
        nama_barang,
        harga,
        stok,
        supplier_id
    )
VALUES
    ('BRG001', 'Beras Premium 5kg', 68000, 100, 1),
    ('BRG002', 'Minyak Goreng 2L', 38000, 80, 1),
    ('BRG003', 'Gula Pasir 1kg', 17500, 120, 2),
    ('BRG004', 'Kopi Bubuk 200g', 22000, 60, 2),
    ('BRG005', 'Teh Celup 25s', 9500, 150, 3),
    ('BRG006', 'Susu UHT 1L', 18500, 90, 3),
    ('BRG007', 'Mie Instan Goreng', 3500, 300, 4),
    ('BRG008', 'Sabun Mandi 100g', 4500, 200, 4),
    ('BRG009', 'Deterjen 800g', 21000, 70, 5),
    ('BRG010', 'Air Mineral 600ml', 3000, 250, 5);

-- Data pelanggan
INSERT INTO
    pelanggan (id, nama, jenis_kelamin, telp, alamat)
VALUES
    (
        'PLG001',
        'Budi Santoso',
        'L',
        '081234567801',
        'Jl. Kenjeran No. 15, Surabaya'
    ),
    (
        'PLG002',
        'Siti Aminah',
        'P',
        '081234567802',
        'Jl. Manyar No. 23, Surabaya'
    ),
    (
        'PLG003',
        'Andi Wijaya',
        'L',
        '081234567803',
        'Jl. Gubeng No. 9, Surabaya'
    ),
    (
        'PLG004',
        'Dewi Lestari',
        'P',
        '081234567804',
        'Jl. Rungkut No. 31, Surabaya'
    ),
    (
        'PLG005',
        'Rudi Hartono',
        'L',
        '081234567805',
        'Jl. Wonokromo No. 5, Surabaya'
    ),
    (
        'PLG006',
        'Rina Marlina',
        'P',
        '081234567806',
        'Jl. Tenggilis No. 18, Surabaya'
    );

-- Data transaksi
INSERT INTO
    transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
VALUES
    ('2026-11-01', 'Belanja bulanan', 174000, 'PLG001'),
    ('2026-11-03', 'Belanja harian', 53500, 'PLG002'),
    (
        '2026-11-05',
        'Pembelian kebutuhan rumah',
        92000,
        'PLG003'
    ),
    ('2026-11-08', 'Belanja mingguan', 61000, 'PLG004'),
    (
        '2026-11-10',
        'Pembelian grosir kecil',
        120000,
        'PLG005'
    ),
    ('2026-11-12', 'Belanja harian', 33500, 'PLG006');

-- Data transaksi_detail
-- (harga x qty dijumlahkan per transaksi = total di tabel transaksi)
INSERT INTO
    transaksi_detail (transaksi_id, barang_id, harga, qty)
VALUES
    -- Transaksi 1: 68000*2 + 38000*1 = 174000
    (1, 1, 68000, 2),
    (1, 2, 38000, 1),
    -- Transaksi 2: 17500*2 + 9500*1 + 3000*3 = 53500
    (2, 3, 17500, 2),
    (2, 5, 9500, 1),
    (2, 10, 3000, 3),
    -- Transaksi 3: 22000*2 + 18500*1 + 4500*6 = 89500 -> disesuaikan di bawah
    (3, 4, 22000, 2),
    (3, 6, 18500, 1),
    (3, 8, 4500, 6),
    -- Transaksi 4: 21000*2 + 9500*2 = 61000
    (4, 9, 21000, 2),
    (4, 5, 9500, 2),
    -- Transaksi 5: 68000*1 + 17500*2 + 3500*5 = 120500 -> disesuaikan di bawah
    (5, 1, 68000, 1),
    (5, 3, 17500, 2),
    (5, 7, 3500, 5),
    -- Transaksi 6: 3500*5 + 3000*5 = 32500 -> disesuaikan di bawah
    (6, 7, 3500, 5),
    (6, 10, 3000, 5);

USE penjualan;

INSERT INTO
    pembayaran (waktu_bayar, total, metode, transaksi_id)
VALUES
    ('2026-11-01 10:15:00', 174000, 'TUNAI', 1),
    ('2026-11-03 14:30:00', 53500, 'TRANSFER', 2),
    ('2026-11-05 09:45:00', 89500, 'EDC', 3),
    ('2026-11-08 16:20:00', 61000, 'TUNAI', 4),
    ('2026-11-10 11:05:00', 120500, 'TRANSFER', 5),
    ('2026-11-12 13:40:00', 32500, 'EDC', 6);

-- Sinkronkan total transaksi dengan hasil perhitungan detail
UPDATE transaksi t
SET
    t.total = (
        SELECT
            SUM(d.harga * d.qty)
        FROM
            transaksi_detail d
        WHERE
            d.transaksi_id = t.id
    );

-- Data pembayaran
-- Data users (password di-hash MD5)
INSERT INTO
    users (username, password, nama, alamat, hp, level)
VALUES
    (
        'admin',
        MD5 ('admin123'),
        'Administrator',
        'Jl. Pemuda No. 1, Surabaya',
        '081300000001',
        1
    ),
    (
        'kasir1',
        MD5 ('kasir123'),
        'Agus Prasetyo',
        'Jl. Ngagel No. 22, Surabaya',
        '081300000002',
        0
    ),
    (
        'kasir2',
        MD5 ('kasir123'),
        'Lina Kusuma',
        'Jl. Darmo No. 14, Surabaya',
        '081300000003',
        0
    );