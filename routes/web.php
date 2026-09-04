<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SizeGuideController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get("/", [LandingController::class, "index"]);
Route::get("/faq", [FaqController::class, "index"]);
Route::get("/cart", [CartController::class, "index"]);
Route::get("/shop", [ShopController::class, "index"]);
Route::get("/terms", [TermsController::class, "index"]);
Route::get("/about", [AboutController::class, "index"]);
Route::get("/privacy", [PrivacyController::class, "index"]);
Route::get("/contact", [ContactController::class, "index"]);
Route::get("/wishlist", [WishlistController::class, "index"]);
Route::get("/checkout", [CheckoutController::class, "index"]);
Route::get("/shipping", [ShippingController::class, "index"]);
Route::get("/size-guide", [SizeGuideController::class, "index"]);
Route::get("/categories", [CategoriesController::class, "index"]);
