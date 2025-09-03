<?php include 'includes\header.php'; ?>

<div class="card shadow-sm mx-auto" style="max-width: 420px;">
  <div class="card-body p-4">
    <h2 class="mb-4 text-center fw-bold">Login</h2>
    <form action="login_action.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control form-control-apple" required>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control form-control-apple" required>
      </div>
      
      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-box-arrow-in-right"></i> Login
      </button>
    </form>
    
    <p class="mt-3 text-center small">
      <a href="forgot_password.php">Forgot Password?</a>
    </p>
  </div>
</div>

<?php include 'includes\footer.php'; ?>
