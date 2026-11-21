<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit();
}

require_once('connect.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5($_POST['pwd']);
    
    $userTable = getUserTable($con);
    $query = mysqli_query($con, "SELECT * FROM $userTable WHERE username = '$username' AND password = '$password'");
    
    if ($query && mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['nama'] = $result['nama'] ?? $result['nama_user'] ?? $result['username'];
        $_SESSION['level'] = (int) $result['level'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Login Gagal, Username atau Password tidak valid!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container" style="max-width: 420px;">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="card-title text-center fw-bold mb-4">LOGIN</h3>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php } ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="pwd" class="form-label fw-semibold">Password</label>
                        <input type="password" name="pwd" id="pwd" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>