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

Route::get("/", [LandingController::class, "index"])->name("landing");

Route::prefix("user")->group(function () {
    Route::get("/faq", [FaqController::class, "index"]);
    Route::get("/cart", [CartController::class, "index"]);
    Route::get("/terms", [TermsController::class, "index"]);
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
    Route::get("/product/{id}", [ProductController::class, "pass_product"]);
    Route::prefix("login")->group(function () {
        Route::get("", [LoginController::class, "index"]);
    });
});

Route::controller(ShopController::class)->group(
    function () {
        Route::prefix("user/shop")->group(function () {
            Route::get("", "pass_products");
            Route::get("/page/{page}", "pass_requested_batch_of_products");
            Route::get("/filter/price/{price}", "pass_products_filtered_by_price");
            Route::get("/category/{category}", "pass_categorized_products");
            Route::get("/category/{category}/filter", "pass_products_filtered_by_category");
            Route::get("/category/{category}/page/{page}", "pass_requested_categorized_batch_of_products");
            Route::get("/category/{category}/filter/price/{price}", "pass_products_filtered_by_category_and_price");
            Route::get("/category", function () {
                return redirect("/shop");
            });
        });
    }
);

// admin
Route::prefix("admin")->group(function () {
    Route::get("/login", function () {
        return view("admin.auth.login");
    });
    Route::get("/dashboard", [DashboardController::class, "index"]);
    Route::get("/settings", function () {
        return view("admin.settings");
    });
    Route::get("/customers", function () {
        return view("admin.customers");
    });
    Route::get("/products", function () {
        return view("admin.products");
    });
    Route::get("/orders", function () {
        return view("admin.orders");
    });
    Route::get("/logout", function () {
        return redirect("admin/login");
    });
    Route::get("/account", function () {
        return view("admin.account");
    });
    Route::get("/analytics", function () {
        return view("admin.analytics");
    });
    Route::get("/product-form", function () {
        return view("admin.product-form");
    });
});

Route::post("/auth/admin/login", function () {
    return redirect("admin/dashboard");
});
Route::post("/auth/user/login", function () {
    return redirect("/user/account");
});
