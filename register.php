<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    try {
      $stmt = $pdo->prepare('INSERT INTO users (full_name, email, phone, password, role) VALUES (?, ?, ?, ?, "borrower")');
      $stmt->execute([$fullName, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]);
      $userId = $pdo->lastInsertId();
      $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
      $stmt->execute([$userId]);
      $user = $stmt->fetch();
      if ($user) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
      }
    } catch (PDOException $e) {
      $error = 'Email already exists.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Register as a borrower to apply for loans and track your status.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Borrower Registration</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3"><label class="form-label">Full Name</label><input name="full_name" class="form-control" required></div>
              <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
              <div class="mb-3"><label class="form-label">Phone</label><input name="phone" class="form-control" required></div>
              <div class="mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" required minlength="6"></div>
              <button class="btn btn-success w-100">Register</button>
            </form>
            <a class="d-block mt-3" href="index.php">Back to login</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
