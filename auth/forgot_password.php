<?php
require_once __DIR__ . '/../includes/config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Save token in DB
        $stmt = $pdo->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$user['id'], $token, $expires]);

        // Reset link (later use real domain)
        $resetLink = "http://localhost/reset_password.php?token=$token";

        // TODO: send via PHPMailer
        $message = "Password reset link: <a href='$resetLink'>$resetLink</a>";
    } else {
        $message = "If this email exists, a reset link has been sent.";
    }
}

include 'header.php';
?>

<div class="card shadow-sm mx-auto" style="max-width: 420px;">
  <div class="card-body p-4">
    <h2 class="mb-4 text-center fw-bold">Forgot Password</h2>
    
    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Enter your email</label>
        <input type="email" name="email" class="form-control form-control-apple" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-envelope"></i> Send Reset Link
      </button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>
