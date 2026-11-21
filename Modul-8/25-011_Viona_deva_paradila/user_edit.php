<?php
require_once('connect.php');
require_once('middleware.php');

if ($_SESSION['level'] != 1) {
    header("Location: index.php");
    exit();
}

$level = $_SESSION['level'] ?? 0;
$nama_user = $_SESSION['nama'] ?? $_SESSION['username'] ?? 'User';
$id = (int) ($_GET['id'] ?? 0);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $user_level = (int)$_POST['level'];
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $pwd = $_POST['pwd'];

    $checkUser = mysqli_query($con, "SELECT id_user FROM users WHERE username = '$username' AND id_user != $id");
    if ($checkUser && mysqli_num_rows($checkUser) > 0) {
        $error = "Username sudah digunakan oleh akun lain.";
    } else {
        if (!empty($pwd)) {
            $pwdHash = md5($pwd);
            $update = mysqli_query($con, "UPDATE users SET username = '$username', password = '$pwdHash', nama = '$nama', level = $user_level WHERE id_user = $id");
        } else {
            $update = mysqli_query($con, "UPDATE users SET username = '$username', nama = '$nama', level = $user_level WHERE id_user = $id");
        }
        if ($update) {
            header("Location: user.php");
            exit();
        } else {
            $error = "Gagal memperbarui data user.";
        }
    }
}

$query = mysqli_query($con, "SELECT * FROM users WHERE id_user = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: user.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Sistem Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">Sistem Penjualan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php if ($level == 1) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item active" href="user.php">Data User</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <?= htmlspecialchars($nama_user) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="card-title fw-bold text-dark mb-4">Edit Data User</h3>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($data['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label fw-semibold">Password Baru (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="pwd" id="pwd" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="level" class="form-label fw-semibold">Level Hak Akses</label>
                        <select name="level" id="level" class="form-select" required>
                            <option value="1" <?= ($data['level'] == 1) ? 'selected' : '' ?>>Owner (Level 1)</option>
                            <option value="2" <?= ($data['level'] == 2) ? 'selected' : '' ?>>Kasir (Level 2)</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="user.php" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>