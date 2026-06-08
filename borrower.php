<?php
require 'config.php';
require_role('borrower');

$user = $_SESSION['user'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'apply_loan') {
    $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
    $purpose = trim($_POST['purpose']);
    $term = filter_var($_POST['term_months'], FILTER_VALIDATE_INT);
    $note = trim($_POST['note']);

    if ($amount > 0 && $purpose !== '' && $term > 0) {
        $stmt = $pdo->prepare('INSERT INTO loans (borrower_id, amount, purpose, term_months, admin_note) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$user['id'], $amount, $purpose, $term, $note]);
        $message = 'Loan application submitted successfully.';
    } else {
        $message = 'Please enter valid loan details.';
    }
}

$stmt = $pdo->prepare('SELECT * FROM loans WHERE borrower_id = ? ORDER BY created_at DESC');
$stmt->execute([$user['id']]);
$loans = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Borrower Dashboard - Loan System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
      <div>
        <h1 class="h3 mb-2">Welcome, <?= e($user['full_name']) ?></h1>
        <p class="text-muted mb-0">Submit loan requests and monitor application status from your borrower dashboard.</p>
      </div>
      <div>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>

    <?php if ($message): ?>
      <div class="alert alert-info"><?= e($message) ?></div>
    <?php endif; ?>

    <div class="row g-4">
      <div class="col-lg-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h5 mb-4">Apply for a Loan</h2>
            <form method="post">
              <input type="hidden" name="action" value="apply_loan">
              <div class="mb-3">
                <label class="form-label">Loan Amount</label>
                <input name="amount" type="number" step="0.01" min="0" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Purpose</label>
                <select name="purpose" class="form-select" required>
                  <option value="">Select purpose</option>
                  <option>Business</option>
                  <option>Education</option>
                  <option>Emergency</option>
                  <option>Agriculture</option>
                  <option>Personal</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Term (months)</label>
                <input name="term_months" type="number" min="1" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Additional Notes</label>
                <textarea name="note" rows="4" class="form-control"></textarea>
              </div>
              <button class="btn btn-success w-100">Submit Loan Request</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="h5 mb-4">Your Loan Requests</h2>
            <?php if (empty($loans)): ?>
              <div class="text-muted">No loan applications submitted yet.</div>
            <?php else: ?>
              <div class="table-responsive">
                <table class="table table-striped align-middle">
                  <thead>
                    <tr>
                      <th>Amount</th>
                      <th>Purpose</th>
                      <th>Term</th>
                      <th>Status</th>
                      <th>Submitted</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($loans as $loan): ?>
                      <tr>
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
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
