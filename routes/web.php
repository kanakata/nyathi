<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PressController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SizeGuideController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;


// LANDING
Route::get("/", [LandingController::class, "index"]);


Route::get("/faq", [FaqController::class, "index"]);

Route::get("/cart", [CartController::class, "index"]);

Route::get("/shop", [ShopController::class, "index"]);
Route::get("/shop/category/{category}", [ShopController::class, "index"]);

Route::get("/terms", [TermsController::class, "index"]);

Route::get("/login", [LoginController::class, "index"]);
Route::post("/login", function () {
    return redirect("/account");
});

Route::get("/register", [RegisterController::class, "index"]);
Route::get("/order-detail", [RegisterController::class, "index"]);
Route::get("/forgot-password", [ForgotPasswordController::class, "index"]);
Route::get("/about", [AboutController::class, "index"]);
Route::get("/privacy", [PrivacyController::class, "index"]);
Route::get("/contact", [ContactController::class, "index"]);
Route::get("/account", [AccountController::class, "index"]);
Route::get("/wishlist", [WishlistController::class, "index"]);
Route::get("/checkout", [CheckoutController::class, "index"]);
Route::get("/shipping", [ShippingController::class, "index"]);
Route::get("/careers", [CareersController::class, "index"]);
Route::get("/press", [PressController::class, "index"]);
Route::get("/size-guide", [SizeGuideController::class, "index"]);
Route::get("/categories", [CategoriesController::class, "index"]);

Route::get("/product/{slug}", [ProductController::class, "index"]);

// admin
Route::get("/admin/login", function () {
    return view("admin.auth.login");
});
Route::get("/admin/dashboard", [DashboardController::class, "index"]);
Route::get("/admin/settings", function () {
    return view("admin.settings");
});
Route::get("/admin/customers", function () {
    return view("admin.customers");
});
Route::get("/admin/products", function () {
    return view("admin.products");
});
Route::get("/admin/orders", function () {
    return view("admin.orders");
});
Route::get("/admin/logout", function () {
    return redirect("admin/login");
});
Route::get("/admin/account", function () {
    return view("admin.account");
});
Route::get("/admin/analytics", function () {
    return view("admin.analytics");
});
Route::get("/admin/product-form", function () {
    return view("admin.product-form");
});
Route::post("/auth/admin/login", function () {
    return redirect("admin/dashboard");
});
