<?php
/**
 * LUXE SHOP — Configuration
 *
 * All backend logic (DB connection, sessions, auth checks) goes here.
 * This file is a placeholder — fill in your own backend details.
 */

// --- Database ---

define('DB_CHARSET', 'utf8mb4');

// --- App ---
define('APP_NAME', 'Pegpem Shop');
define('APP_URL', 'http://localhost/shop');
define('APP_VERSION', '1.0.0');

// --- Currency ---
define('CURRENCY_SYMBOL', 'Ksh: ');
define('CURRENCY_CODE', 'KSH');

// --- Shipping ---
define('FREE_SHIPPING_THRESHOLD', 150.00);
define('DEFAULT_SHIPPING_COST', 9.99);

// --- Pagination ---
define('PRODUCTS_PER_PAGE', 12);

function price(float $amount): string
{
    return CURRENCY_SYMBOL . number_format($amount, 2, ".", ",");
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function isAdmin(): bool
{
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
