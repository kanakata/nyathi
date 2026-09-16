@php
    $pageTitle = 'Create Account — Nyathi Shop';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ e($pageTitle) }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>

    <div class="auth-page">

        <div class="auth-visual" style="display:block;flex:1">
            <div
                style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(13,13,13,0.75),rgba(201,169,110,0.12)), url('/assets/images/IMG-20260822-WA0023.jpg') center/cover no-repeat">
            </div>
            <div class="auth-visual-content">
                <a href="/" class="logo">Nyathi<span>.</span></a>
                <div style="margin-top:3rem">
                    <h2 style="color:#fff;margin-bottom:0.75rem">Join Nyathi today.</h2>
                    <p style="color:rgba(255,255,255,0.6)">Create your account and enjoy exclusive member benefits,
                        early access to sales, and a seamless shopping experience.</p>
                </div>
            </div>
        </div>

        <div class="auth-panel">
            <div class="auth-logo">
                <a href="/" class="logo">Nyathi<span>.</span></a>
            </div>
            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Already have one? <a href="/user/login" style="color:var(--gold)">Sign in</a></p>

            @if (!empty($_GET['error']))
                <div class="alert alert-error">{{ e($_GET['error']) }}</div>
            @endif

            <form method="POST" action="/register-process">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" required
                            value="{{ e($_POST['first_name'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required
                            value="{{ e($_POST['last_name'] ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="email" required
                        value="{{ e($_POST['email'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position:relative">
                        <input type="password" id="password" name="password" class="form-control" minlength="8"
                            required>
                        <button id="show-password" type="button" data-toggle-password="password">~_~</button>
                    </div>
                    <small style="color:var(--text-muted);font-size:0.72rem;display:block;margin-top:0.3rem">At least 8
                        characters</small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>

                <div style="display:flex;align-items:flex-start;gap:0.5rem;margin-bottom:1.5rem">
                    <input type="checkbox" id="newsletter" name="newsletter" value="1"
                        style="accent-color:var(--gold);margin-top:2px">
                    <label for="newsletter" style="font-size:0.82rem;color:var(--text-muted);cursor:pointer">Subscribe
                        to our newsletter for exclusive offers and new arrivals.</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Create Account</button>

                <p class="auth-footer" style="margin-top:1rem">By creating an account, you agree to our <a
                        href="/user/terms">Terms of Service</a> and <a href="/user/privacy">Privacy Policy</a>.</p>
            </form>
        </div>

    </div>

    <script src="/js/app.js"></script>
    <script>
        // Password match validation
        document.querySelector('form')?.addEventListener('submit', e => {
            const p1 = document.getElementById('password').value;
            const p2 = document.getElementById('confirm_password').value;
            if (p1 !== p2) {
                e.preventDefault();
                alert('Passwords do not match.');
            }
        });
    </script>
</body>

</html>
