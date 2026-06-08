<?php
require 'config.php';
require_role('admin');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loan_id'], $_POST['status'])) {
    $loanId = (int) $_POST['loan_id'];
    $status = $_POST['status'] === 'approved' ? 'approved' : 'rejected';
    $stmt = $pdo->prepare('UPDATE loans SET status = ? WHERE id = ?');
    $stmt->execute([$status, $loanId]);
    $message = 'Loan status updated.';
}

$stmt = $pdo->query('SELECT l.*, u.full_name, u.email, u.phone FROM loans l JOIN users u ON l.borrower_id = u.id ORDER BY l.created_at DESC');
$loans = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
      <div>
        <h1 class="h3 mb-2">Admin Dashboard</h1>
        <p class="text-muted mb-0">Review borrower loan applications and take action from the dashboard.</p>
      </div>
      <div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>

    <?php if ($message): ?>
      <div class="alert alert-info"><?= e($message) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>Borrower</th>
                <th>Amount</th>
                <th>Purpose</th>
                <th>Term</th>
                <th>Status</th>
                <th>Submitted</th>
                <th class="text-end">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($loans)): ?>
                <tr>
                  <td colspan="7" class="text-muted">No loan applications found.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($loans as $loan): ?>
                  <tr>
                    <td>
                      <strong><?= e($loan['full_name']) ?></strong><br>
                      <small><?= e($loan['email']) ?> &bull; <?= e($loan['phone']) ?></small>
                    </td>
                    <td><?= number_format($loan['amount'], 2) ?></td>
                    <td><?= e($loan['purpose']) ?></td>
                    <td><?= e($loan['term_months']) ?> mo</td>
                    <td>
                      <?php if ($loan['status'] === 'pending'): ?>
                        <span class="badge status-pending">Pending</span>
                      <?php elseif ($loan['status'] === 'approved'): ?>
                        <span class="badge status-approved">Approved</span>
                      <?php elseif ($loan['status'] === 'rejected'): ?>
                        <span class="badge status-rejected">Rejected</span>
                      <?php else: ?>
                        <span class="badge bg-secondary"><?= e($loan['status']) ?></span>
                      <?php endif; ?>
                    </td>
                    <td><?= date('Y-m-d', strtotime($loan['created_at'])) ?></td>
                    <td class="text-end">
                      <?php if ($loan['status'] === 'pending'): ?>
                        <form method="post" class="d-inline">
                          <input type="hidden" name="loan_id" value="<?= e($loan['id']) ?>">
                          <input type="hidden" name="status" value="approved">
                          <button class="btn btn-primary btn-sm">Approve</button>
                        </form>
                        <form method="post" class="d-inline ms-2">
                          <input type="hidden" name="loan_id" value="<?= e($loan['id']) ?>">
                          <input type="hidden" name="status" value="rejected">
                          <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                      <?php else: ?>
                        <span class="text-muted">No actions</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
