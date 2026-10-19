<?php

use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\User\AboutController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\CareersController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FaqController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\LandingController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\PressController;
use App\Http\Controllers\User\PrivacyController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ShippingController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\SizeGuideController;
use App\Http\Controllers\User\TermsController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware('cache.headers:public;max_age=30;s_maxage=300;stale_while_revalidate=600;etag')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing');

    Route::prefix('user')->group(function () {
        Route::get('/faq', [FaqController::class, 'index']);
        Route::get('/cart', [CartController::class, 'index']);
        Route::get('/terms', [TermsController::class, 'index']);
        Route::get('/register', [RegisterController::class, 'index']);
        Route::get('/order-detail', [RegisterController::class, 'index']);
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index']);
        Route::get('/about', [AboutController::class, 'index']);
        Route::get('/privacy', [PrivacyController::class, 'index']);
        Route::get('/contact', [ContactController::class, 'index']);
        Route::get('/account', [AccountController::class, 'index']);
        Route::get('/wishlist', [WishlistController::class, 'index']);
        Route::get('/checkout', [CheckoutController::class, 'index']);
        Route::get('/shipping', [ShippingController::class, 'index']);
        Route::get('/careers', [CareersController::class, 'index']);
        Route::get('/press', [PressController::class, 'index']);
        Route::get('/size-guide', [SizeGuideController::class, 'index']);
        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::get('/product/{id}', [ProductController::class, 'pass_product']);
        Route::prefix('login')->group(function () {
            Route::get('', [LoginController::class, 'index']);
        });
    });

    Route::controller(ProductController::class)->group(function () {
        Route::prefix('product')->group(function () {
            Route::post('/order', 'process_order');
        });
    });

    Route::controller(ShopController::class)->group(
        function () {
            Route::prefix('user/shop')->group(function () {
                Route::get('', 'pass_products');
                Route::get('/page/{page}', 'pass_requested_batch_of_products');
                Route::get('/filter/price/{price}', 'pass_products_filtered_by_price');
                Route::get('/category/{category}', 'pass_categorized_products');
                Route::get('/category/{category}/filter', 'pass_products_filtered_by_category');
                Route::get('/category/{category}/page/{page}', 'pass_requested_categorized_batch_of_products');
                Route::get('/category/{category}/filter/price/{price}', 'pass_products_filtered_by_category_and_price');
                Route::get('/category', function () {
                    return redirect('/shop');
                });
            });
        }
    );

    // admin
    Route::prefix('admin')->group(function () {
        Route::get('/login', function () {
            return view('admin.auth.login');
        });
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/settings', function () {
            return view('admin.pages.settings');
        });
        Route::get('/customers', function () {
            return view('admin.pages.customers');
        });
        Route::get('/products', [ProductsController::class, 'pass_products']);
        Route::get('/product/delete/{id}', [ProductsController::class, 'delete_product']);
        Route::post('/product-save', [ProductsController::class, 'save_product']);
        Route::get('/orders', function () {
            return view('admin.pages.orders');
        });
        Route::get('/logout', function () {
            return redirect('admin/login');
        });
        Route::get('/analytics', function () {
            return view('admin.pages.analytics');
        });
        Route::get('/product-form', function () {
            // colors
            $colors = ['red', 'white', 'blue', 'black', 'green', 'yellow', 'orange', 'purple', 'pink', 'brown', 'gray', 'cyan', 'magenta', 'lime', 'teal', 'indigo', 'violet', 'gold', 'silver', 'bronze', 'maroon', 'navy', 'olive', 'aqua', 'fuchsia', 'coral', 'salmon', 'khaki', 'lavender', 'plum', 'orchid', 'periwinkle', 'mint', 'peach', 'apricot', 'amber', 'cerulean', 'sapphire', 'emerald', 'ruby', 'topaz', 'turquoise', 'jade', 'onyx', 'ivory', 'ebony', 'rose', 'cherry', 'cobalt', 'pearl', 'sienna', 'tan', 'taupe', 'wheat', 'mustard', 'copper', 'bronze', 'brass', 'platinum', 'rose gold', 'champagne', 'blush', 'fawn', 'sage', 'fern', 'moss', 'pine', 'spruce', 'teal blue', 'aqua marine', 'seafoam green', 'mint green', 'lime green', 'chartreuse', 'olive drab', 'khaki green', 'pearl white', 'jet black', 'ruby red', 'sapphire blue', 'emerald green', 'amethyst purple', 'citrine yellow', 'topaz orange', 'turquoise teal', 'opal pink', 'garnet maroon', 'peridot lime', 'aquamarine cyan', 'moonstone silver', 'sunstone gold', 'labradorite gray', 'onyx black', 'malachite green', 'lapis lazuli blue', 'tanzanite purple', 'carnelian red', 'aventurine green', 'rhodonite pink', 'chalcedony blue', 'jasper brown', 'agate gray', 'obsidian black', 'sodalite blue', 'fluorite purple', 'hematite silver', 'pyrite gold', 'serpentine green', 'azurite blue', 'rhodochrosite pink', 'tourmaline multicolor', 'zircon clear', 'spinel red', 'kunzite pink', 'iolite violet', 'chrysoberyl yellow', 'alexandrite green', 'diopside green', 'euclase blue', 'garnet orange', 'kyanite blue', 'lepidolite purple', 'morganite peach', 'prehnite green', 'rutilated quartz gold', 'scapolite yellow', 'sphene green', 'tremolite green', 'vesuvianite green', 'wulfenite orange', 'zincite red', 'zoisite green', 'seraphinite green', 'sugilite purple', 'tiger eye brown', 'unakite green', 'variscite green', 'wulfenite yellow', 'xenotime brown', 'yukonite yellow', 'zincite orange', 'zircon blue', 'zoisite pink', 'serpentine yellow', 'sodalite gray', 'spinel blue', 'sugilite pink', 'tiger eye gold', 'unakite pink', 'variscite blue', 'wulfenite red', 'xenotime yellow', 'yukonite green', 'zincite blue', 'zircon green', 'zoisite blue', 'serpentine blue', 'sodalite pink', 'spinel green', 'sugilite blue', 'tiger eye silver', 'unakite blue', 'variscite pink', 'wulfenite green', 'xenotime pink', 'yukonite blue', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver'];

            // normal cloth sizes
            $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4XL', '5XL', '6XL', '7XL', '8XL', '9XL', '10XL', '11XL', '12XL', '13XL', '14XL', '15XL', '16XL', '17XL', '18XL', '19XL', '20XL', '21XL', '22XL', '23XL', '24XL', '25XL', '26XL', '27XL', '28XL', '29XL', '30XL', '31XL', '32XL', '33XL', '34XL', '35XL', '36XL', '37XL', '38XL', '39XL', '40XL', '41XL', '42XL', '43XL', '44XL', '45XL', '46XL', '47XL', '48XL', '49XL', '50XL', '51XL', '52XL', '53XL', '54XL', '55XL', '56XL', '57XL', '58XL', '59XL', '60XL', '61XL', '62XL', '63XL', '64XL', '65XL', '66XL', '67XL', '68XL', '69XL', '70XL', '71XL', '72XL', '73XL', '74XL', '75XL', '76XL', '77XL', '78XL', '79XL', '80XL', '81XL', '82XL', '83XL', '84XL', '85XL', '86XL', '87XL', '88XL', '89XL', '90XL', '91XL', '92XL', '93XL', '94XL', '95XL', '96XL', '97XL', '98XL', '99XL', '100XL'];

            // shoes sizes
            $shoe_sizes = ['5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13', '13.5', '14', '14.5', '15', '15.5', '16', '16.5', '17', '17.5', '18', '18.5', '19', '19.5', '20', '20.5', '21', '21.5', '22', '22.5', '23', '23.5', '24', '24.5', '25', '25.5', '26', '26.5', '27', '27.5', '28', '28.5', '29', '29.5', '30', '30.5', '31', '31.5', '32', '32.5', '33', '33.5', '34', '34.5', '35', '35.5', '36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5', '45', '45.5', '46', '46.5', '47', '47.5', '48', '48.5', '49', '49.5', '50', '50.5', '51', '51.5', '52', '52.5', '53', '53.5', '54', '54.5', '55', '55.5', '56', '56.5', '57', '57.5', '58', '58.5', '59', '59.5', '60'];

            // brands
            $brands = ['Nike', 'Adidas', 'Puma', 'Reebok', 'Under Armour', 'New Balance', 'Asics', 'Converse', 'Vans', 'Fila', 'Skechers', 'Jordan', 'Champion', 'Columbia', 'The North Face', 'Patagonia', 'Salomon', 'Mizuno', 'Brooks', 'Hoka One One', 'Merrell', 'Timberland', 'Dr. Martens', 'Clarks', 'Birkenstock', 'Teva', 'Keen', 'Chaco', 'Oboz', 'Vasque', 'La Sportiva', 'Scarpa', 'Arcteryx', 'Mammut', 'Black Diamond', 'Mountain Hardwear', 'Outdoor Research', 'Rab', 'Montbell', 'Eddie Bauer', 'L.L.Bean', 'Patagonia', 'Fjällräven', 'Haglöfs', 'Jack Wolfskin', 'Marmot', 'Berghaus', 'Craghoppers', 'Rab', 'Montane', 'Rab', 'Montbell', 'Eddie Bauer', 'L.L.Bean', 'Patagonia', 'Fjällräven', 'Haglöfs', 'Jack Wolfskin', 'Marmot', 'Berghaus', 'Craghoppers', 'Rab', 'Montane', 'Rab', 'Montbell', 'Eddie Bauer', 'L.L.Bean', 'Patagonia', 'Fjällräven', 'Haglöfs', 'Jack Wolfskin', 'Marmot', 'Berghaus', 'Craghoppers', 'Rab', 'Montane'];

            return view('admin.pages.product-form', [
                'colors' => $colors,
                'sizes' => $sizes,
                'shoe_sizes' => $shoe_sizes,
                'brands' => $brands,
            ]);
        });
    });

    Route::post('/auth/admin/login', function () {
        return redirect('admin/dashboard');
    });
    Route::post('/user/auth/login', [LoginController::class, 'login']);
    Route::post('/user/auth/register', [RegisterController::class, 'register']);

});
