USE penjualan;

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Makmur',   '0315550101', 'Jl. Rungkut Industri No. 12, Surabaya'),
(2, 'CV Jaya Abadi',      '0315550202', 'Jl. Darmo Permai No. 45, Surabaya'),
(3, 'UD Berkah Sentosa',  '0315550303', 'Jl. Ahmad Yani No. 78, Sidoarjo'),
(4, 'PT Maju Bersama',    '0315550404', 'Jl. Raya Gresik No. 5, Gresik'),
(5, 'CV Mitra Sejahtera', '0315550505', 'Jl. Pemuda No. 21, Surabaya'),
(6,  'PT Garuda Pangan',      '0315550606', 'Jl. Margomulyo Indah No. 8, Surabaya'),
(7,  'CV Cahaya Mandiri',     '0315550707', 'Jl. Tenggilis Mejoyo No. 33, Surabaya'),
(8,  'UD Rejeki Nomplok',     '0315550808', 'Jl. Raya Waru No. 102, Sidoarjo'),
(9,  'PT Nusantara Niaga',    '0315550909', 'Jl. Veteran No. 17, Gresik'),
(10, 'CV Sinar Terang',       '0315551010', 'Jl. Kenjeran No. 56, Surabaya'),
(11, 'PT Surya Distribusi',   '0341555111', 'Jl. Soekarno Hatta No. 24, Malang'),
(12, 'UD Tani Makmur',        '0343555212', 'Jl. Raya Bangil No. 9, Pasuruan'),
(13, 'CV Prima Utama',        '0321555313', 'Jl. Raya Mojosari No. 40, Mojokerto'),
(14, 'PT Cipta Boga Lestari', '0331555414', 'Jl. Gajah Mada No. 63, Jember'),
(15, 'UD Harapan Baru',       '0315551515', 'Jl. Gubeng Kertajaya No. 11, Surabaya');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Beras Premium 5kg',   65000, 100, 1),
(2, 'BRG002', 'Minyak Goreng 2L',    38000,  80, 1),
(3, 'BRG003', 'Gula Pasir 1kg',      17000, 120, 2),
(4, 'BRG004', 'Kopi Bubuk 200g',     22000,  60, 2),
(5, 'BRG005', 'Teh Celup Isi 25',     9000, 150, 3),
(6, 'BRG006', 'Mi Instan Goreng',     3500, 300, 3),
(7, 'BRG007', 'Sabun Mandi Batang',   5500, 200, 4),
(8, 'BRG008', 'Deterjen Bubuk 1kg',  24000,  90, 5),
(9, 'BRG009', 'Susu UHT 1L',  28000,  10000, 5),
(10, 'BRG010', 'Tepung Terigu 1kg',        12500, 140, 6),
(11, 'BRG011', 'Telur Ayam 1kg',           29000,  75, 6),
(12, 'BRG012', 'Garam Dapur 250g',          3000, 220, 7),
(13, 'BRG013', 'Kecap Manis 600ml',        21000,  95, 7),
(14, 'BRG014', 'Saus Sambal 340ml',        13500, 110, 8),
(15, 'BRG015', 'Santan Instan 200ml',       6500, 180, 8),
(16, 'BRG016', 'Sarden Kaleng 155g',       12000,  85, 9),
(17, 'BRG017', 'Kornet Sapi 198g',         28000,  50, 9),
(18, 'BRG018', 'Biskuit Kelapa 300g',      15000, 130, 10),
(19, 'BRG019', 'Wafer Cokelat 150g',       11000, 160, 10),
(20, 'BRG020', 'Air Mineral 600ml',         3500, 400, 11),
(21, 'BRG021', 'Air Mineral Galon 19L',    20000,  60, 11),
(22, 'BRG022', 'Jus Jeruk Kemasan 1L',     18500,  70, 12),
(23, 'BRG023', 'Madu Murni 250ml',         45000,  40, 12),
(24, 'BRG024', 'Pasta Gigi 120g',          12000, 190, 13),
(25, 'BRG025', 'Sikat Gigi Dewasa',         8500, 170, 13),
(26, 'BRG026', 'Shampoo Sachet (isi 12)',  14000, 125, 14),
(27, 'BRG027', 'Sabun Cuci Piring 800ml',  16500, 105, 14),
(28, 'BRG028', 'Pewangi Pakaian 900ml',    19500,  88, 15),
(29, 'BRG029', 'Tisu Wajah 250 Lembar',    14500, 210, 15),
(30, 'BRG030', 'Popok Bayi Size M (isi 30)', 68000, 45, 1),
(31, 'BRG031', 'Cokelat Batang 80g',       12500, 135, 2),
(32, 'BRG032', 'Kacang Tanah Kulit 500g',  22000,  65, 3),
(33, 'BRG033', 'Bawang Merah 1kg',         35000,  55, 4),
(34, 'BRG034', 'Cabai Rawit Merah 250g',   18000,  30, 5);



INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso',   'L', '081234567801', 'Jl. Kenjeran No. 10, Surabaya'),
('PLG002', 'Siti Aminah',    'P', '081234567802', 'Jl. Mulyorejo No. 23, Surabaya'),
('PLG003', 'Agus Prasetyo',  'L', '081234567803', 'Jl. Gubeng Kertajaya No. 7, Surabaya'),
('PLG004', 'Dewi Lestari',   'P', '081234567804', 'Jl. Wonokromo No. 15, Surabaya'),
('PLG005', 'Rudi Hartono',   'L', '081234567805', 'Jl. Tenggilis No. 31, Surabaya'),
('PLG006', 'Ratna Sari',     'P', '081234567806', 'Jl. Manyar Jaya No. 9, Surabaya');


INSERT INTO `users` (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin',  MD5('admin123'),  'Administrator',  'Jl. Pahlawan No. 1, Surabaya',  '081300000001', 1),
(2, 'kasir1', MD5('kasir123'),  'Andi Wijaya',    'Jl. Diponegoro No. 8, Surabaya','081300000002', 2),
(3, 'kasir2', MD5('kasir123'),  'Lina Marlina',   'Jl. Basuki Rahmat No. 17, Surabaya','081300000003', 2),
(4, 'gudang', MD5('gudang123'), 'Hendra Gunawan', 'Jl. Embong Malang No. 4, Surabaya','081300000004', 3),
(5, 'owner',  MD5('owner123'),  'Bambang Susilo', 'Jl. Raya Darmo No. 99, Surabaya','081300000005', 1);






INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1,  '2026-10-01', 'Belanja bulanan',        147000, 'PLG001'),
(2,  '2026-10-02', 'Pembelian harian',        73000, 'PLG002'),
(3,  '2026-10-03', 'Stok warung',             71000, 'PLG003'),
(4,  '2026-10-05', 'Kebutuhan rumah tangga',  70000, 'PLG004'),
(5,  '2026-10-07', 'Belanja bulanan',        141000, 'PLG005'),
(6,  '2026-10-09', 'Pembelian gula',          85000, 'PLG001'),
(7,  '2026-10-12', 'Stok mi dan teh',         88000, 'PLG006'),
(8,  '2026-10-15', 'Kebutuhan cuci',          83000, 'PLG002'),
(9,  '2026-10-18', 'Pembelian beras',        195000, 'PLG003'),
(10, '2026-10-21', 'Belanja campuran',        94000, 'PLG004'),
(11, '2026-10-25', 'Pembelian harian',        53500, 'PLG005'),
(12, '2026-11-01', 'Belanja bulanan',        138000, 'PLG006');


INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,  1, 65000,  2),
(1,  3, 17000,  1),
(2,  2, 38000,  1),
(2,  6,  3500, 10),
(3,  4, 22000,  2),
(3,  5,  9000,  3),
(4,  7,  5500,  4),
(4,  8, 24000,  2),
(5,  1, 65000,  1),
(5,  2, 38000,  2),
(6,  3, 17000,  5),
(7,  6,  3500, 20),
(7,  5,  9000,  2),
(8,  8, 24000,  3),
(8,  7,  5500,  2),
(9,  1, 65000,  3),
(10, 4, 22000,  1),
(10, 3, 17000,  2),
(10, 2, 38000,  1),
(11, 5,  9000,  4),
(11, 6,  3500,  5),
(12, 2, 38000,  3),
(12, 8, 24000,  1);


INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1,  '2026-10-01 09:15:00', 147000, 'TUNAI',    1),
(2,  '2026-10-02 10:30:00',  73000, 'TRANSFER', 2),
(3,  '2026-10-03 11:05:00',  71000, 'TUNAI',    3),
(4,  '2026-10-05 14:20:00',  70000, 'EDC',      4),
(5,  '2026-10-07 08:45:00', 141000, 'TRANSFER', 5),
(6,  '2026-10-09 16:10:00',  85000, 'TUNAI',    6),
(7,  '2026-10-12 13:00:00',  88000, 'EDC',      7),
(8,  '2026-10-15 15:40:00',  83000, 'TUNAI',    8),
(9,  '2026-10-18 09:55:00', 195000, 'TRANSFER', 9),
(10, '2026-10-21 12:25:00',  94000, 'EDC',     10),
(11, '2026-10-25 17:00:00',  53500, 'TUNAI',   11),
(12, '2026-11-01 10:10:00', 138000, 'TRANSFER',12);
