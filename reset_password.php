<?php
require 'config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $newPassword = $_POST['password'];
    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
    $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $email]);
    $message = $stmt->rowCount() ? 'Password reset successfully.' : 'Email not found.';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Reset your borrower account password securely.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm"><div class="card-body p-4">
          <h1 class="h3 mb-3">Reset Password</h1>
          <?php if ($message): ?><div class="alert alert-info"><?= e($message) ?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">New Password</label><input name="password" type="password" class="form-control" required minlength="6"></div>
            <button class="btn btn-success w-100">Reset</button>
          </form>
          <a class="d-block mt-3" href="index.php">Back to login</a>
        </div></div>
      </div>
    </div>
  </main>
</body>
</html>
