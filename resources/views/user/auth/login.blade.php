<?php
/**
 * Nyathi SHOP — Login Page
 */
// require_once __DIR__ . '/../includes/config';
// if (isLoggedIn()) redirect('/pages/account');

$pageTitle = 'Sign In — Nyathi Shop';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="auth-page">

        <!-- Visual Side -->
        <div class="auth-visual" style="display:block;flex:1">
            <div
                style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,13,13,0.75),rgba(201,169,110,0.12)),url('/assets/images/IMG-20260822-WA0023.jpg') center/cover no-repeat">
            </div>
            <div class="auth-visual-content">
                <a href="/" class="logo">Nyathi<span>.</span></a>
                <div style="margin-top:3rem">
                    <h2 style="color:#fff;margin-bottom:0.75rem">Welcome back.</h2>
                    <p style="color:rgba(255,255,255,0.6)">Sign in to access your saved items, order history, and
                        exclusive member offers.</p>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="auth-panel">
            <div class="auth-logo">
                <a href="/" class="logo">Nyathi<span>.</span></a>
            </div>
            <h2 class="auth-title">Sign In</h2>
            <p class="auth-subtitle">New here? <a href="/register" style="color:var(--gold)">Create an account</a></p>

            <?php if (!empty($_GET['error'])): ?>
            <div class="alert alert-error"><?= e($_GET['error']) ?></div>
            <?php endif; ?>

            <?php if (!empty($_GET['success'])): ?>
            <div class="alert alert-success"><?= e($_GET['success']) ?></div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <?php if (!empty($_GET['redirect'])): ?>
                <input type="hidden" name="redirect" value="<?= e($_GET['redirect']) ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="email" required
                        value="<?= e($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="password" style="display:flex;justify-content:space-between">
                        Password
                        <a href="/forgot-password" style="color:var(--gold);font-size:0.75rem">Forgot?</a>
                    </label>
                    <div style="position:relative">
                        <input type="password" id="password" name="password" class="form-control"
                            autocomplete="current-password" required>
                        <button type="button" data-toggle-password="password"
                            style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-muted);cursor:pointer;font-size:0.85rem">👁</button>
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1.5rem">
                    <input type="checkbox" id="remember" name="remember" value="1" style="accent-color:var(--gold)">
                    <label for="remember" style="font-size:0.82rem;color:var(--text-muted);cursor:pointer">Remember me
                        for 30 days</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>

            <div class="auth-divider"><span>or continue with</span></div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem">
                <a href="/oauth?provider=google" class="btn btn-ghost">
                    <svg width="16" height="16" viewBox="0 0 24 24">
                        <path fill="#EA4335"
                            d="M5.27 9.76A7.08 7.08 0 0 1 12 4.9c1.69 0 3.22.6 4.41 1.59L19.9 3A11.97 11.97 0 0 0 12 0C8.31 0 5.11 1.9 3.17 4.76l2.1 5z" />
                        <path fill="#34A853"
                            d="M16.04 18.01A7.07 7.07 0 0 1 12 19.1c-2.9 0-5.39-1.75-6.62-4.3L3.2 19.23C5.13 22.1 8.33 24 12 24c3.32 0 6.3-1.26 8.56-3.31l-4.52-2.68z" />
                        <path fill="#FBBC05"
                            d="M19.1 12c0-.73-.1-1.44-.25-2.12H12v4.12h4.02a3.43 3.43 0 0 1-1.48 2.26l4.52 2.69c2.64-2.44 4.04-6.04 4.04-6.95z" />
                        <path fill="#4285F4"
                            d="M5.38 14.8A7.12 7.12 0 0 1 4.9 12c0-.98.17-1.93.48-2.8L3.17 4.76A11.9 11.9 0 0 0 0 12c0 1.93.46 3.75 1.27 5.37l4.11-2.57z" />
                    </svg>
                    Google
                </a>
                <a href="/oauth?provider=facebook" class="btn btn-ghost">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                    Facebook
                </a>
            </div>

            <p class="auth-footer">By signing in, you agree to our <a href="/pages/terms">Terms</a> and <a
                    href="/pages/privacy">Privacy Policy</a>.</p>
        </div>

    </div>

    <script src="/assets/js/main.js"></script>
</body>

</html>
