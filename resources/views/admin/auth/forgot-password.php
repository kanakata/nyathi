<?php
/**
 * LUXE SHOP — Forgot Password
 */
$pageTitle = 'Reset Password — Luxe Shop';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="auth-page" style="justify-content:center">
  <div class="auth-panel" style="max-width:440px">
    <div class="auth-logo"><a href="/index.php" class="logo">Luxe<span>.</span></a></div>
    <h2 class="auth-title">Reset Password</h2>
    <p class="auth-subtitle">Enter your email and we'll send you a reset link.</p>
    <form method="POST" action="/auth/forgot-process.php">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
    </form>
    <p class="auth-footer mt-2"><a href="/auth/login.php" style="color:var(--gold)">← Back to Sign In</a></p>
  </div>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
