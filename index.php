<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
<?php
require 'config.php';
if (!empty($_SESSION['user'])) redirect_to_dashboard();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect_to_dashboard();
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="text-center mb-4">
      <span class="brand d-block mb-1">Loan Application System</span>
      <p class="text-muted mb-0">Sign in to access your borrower dashboard or manage loans.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h1 class="h3 mb-3">Loan System Login</h1>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
              </div>
              <button class="btn btn-success w-100">Login</button>
            </form>
            <div class="d-flex justify-content-between mt-3">
              <a href="register.php">Create borrower account</a>
              <a href="reset_password.php">Reset password</a>
            </div>
            <p class="text-muted small mt-3 mb-0">Admin: admin@loan.test / admin123</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
