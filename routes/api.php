<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\UserDashboardController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\BannerController;


// ============================================
// PUBLIC AUTHENTICATION ROUTES
// Dual Verification System (Email + SMS)
// ============================================
Route::prefix('auth')->group(function () {
    // Registration
    Route::post('/register', [AuthController::class, 'register']);
    
    // Login
    Route::post('/login', [AuthController::class, 'login']);
    
    // Email Verification (Step 1 of 2)
    Route::post('/verify-email-code', [AuthController::class, 'verifyEmailCode']);
    Route::post('/resend-email-verification', [AuthController::class, 'resendEmailVerificationCode']);
    
    // SMS Verification (Step 2 of 2)
    Route::post('/verify-sms-code', [AuthController::class, 'verifySmsCode']);
    Route::post('/resend-sms-verification', [AuthController::class, 'resendSmsVerificationCode']);
});

// Legacy auth routes (for backward compatibility - can be removed after migration)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verify-email-code', [AuthController::class, 'verifyEmailCode']);
Route::post('verify-sms-code', [AuthController::class, 'verifySmsCode']);
Route::post('resend-email-verification', [AuthController::class, 'resendEmailVerificationCode']);
Route::post('resend-sms-verification', [AuthController::class, 'resendSmsVerificationCode']);

// ============================================
// PUBLIC PRODUCT ROUTES
// ✅ Includes advanced filtering, sorting, and material variations
// ============================================
Route::prefix('products')->group(function () {
    // Get all products with advanced filters (price range, colors, sizes, materials, ratings)
    Route::get('/', [ProductController::class, 'getAllProducts']);
    
    // Search products (multi-term, category/subcategory support)
    Route::get('/search', [ProductController::class, 'searchProducts']);
    
    // Get category hierarchy
    Route::get('/categories', [ProductController::class, 'getCategories']);
    Route::get('/categories/{categoryId}/subcategories', [ProductController::class, 'getSubcategories']);
    Route::get('/subcategories/{subcategoryId}/sub-subcategories', [ProductController::class, 'getSubSubcategories']);
    
    // Get all variations (colors with hex, sizes, materials)
    Route::get('/variations', [ProductController::class, 'getVariations']);
    
    // Filter products (advanced filtering with material support)
    Route::get('/filter', [ProductController::class, 'filterProducts']);
    
    // Get products by category path
    Route::get('/category/{category?}/{subcategory?}/{subsubcategory?}', [ProductController::class, 'getProductsByCategory']);
    
    // Get single product (includes reviews, related products, shipping info)
    // Note: Shipping is informational only - actual fee calculated in cart/checkout
    Route::get('/{product_id}', [ProductController::class, 'getProduct']);
});

// ============================================
// PUBLIC PAYMENT CALLBACK ROUTE
// OnePay payment gateway webhook
// ============================================
Route::post('/payment/callback', [PaymentController::class, 'handleCallback']);

// ============================================
// PROTECTED ROUTES (Require Authentication)
// All routes below require auth:sanctum middleware
// ============================================
Route::middleware('auth:sanctum')->group(function () {
    
    // ========================================
    // PROFILE ROUTES
    // User profile management
    // ========================================
    Route::prefix('profile')->group(function () {
        Route::get('/', [AuthController::class, 'profile']);
        Route::put('/', [AuthController::class, 'updateProfile']);
        Route::post('/image', [AuthController::class, 'updateProfileImage']);
        Route::delete('/image', [AuthController::class, 'deleteProfileImage']);
    });
    
    // ========================================
    // AUTHENTICATION ROUTES
    // Password change and logout
    // ========================================
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('logout', [AuthController::class, 'logout']);

    // ========================================
    // WISHLIST ROUTES
    // Manage user wishlist
    // ========================================
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'getWishlist']);
        Route::post('/toggle', [WishlistController::class, 'toggleWishlist']);
        Route::post('/check-multiple', [WishlistController::class, 'checkMultipleWishlist']);
        Route::delete('/{id}', [WishlistController::class, 'removeFromWishlist']);
        Route::get('/count', [WishlistController::class, 'getWishlistCount']);
    });

    // ========================================
    // CART ROUTES
    // ✅ Single source of truth for delivery fee calculation
    // Shopping cart management with product-specific shipping
    // ========================================
    Route::prefix('cart')->group(function () {
        // Get cart with calculated delivery fee (uses product-specific shipping charges)
        Route::get('/', [CartController::class, 'getCart']);
        
        // Add to cart (with material variation support)
        Route::post('/add', [CartController::class, 'addToCart']);
        
        // Add to affiliate cart
        Route::post('/add-affiliate', [CartController::class, 'addToCartAffiliate']);
        
        // Update cart item quantity
        Route::put('/update', [CartController::class, 'updateCartItem']);
        
        // Remove single item from cart
        Route::delete('/{cartId}', [CartController::class, 'removeFromCart']);
        
        // Clear entire cart
        Route::delete('/', [CartController::class, 'clearCart']);
        
        // Get cart item count
        Route::get('/count', [CartController::class, 'getCartCount']);
        
        // Get cart subtotal (without delivery)
        Route::get('/subtotal', [CartController::class, 'getCartSubtotal']);
    });

    // ========================================
    // CHECKOUT ROUTES
    //  OPTIMIZED: Reuses cart's shipping calculation (cached)
    // Includes discount calculation & material variations
    // ========================================
    Route::prefix('checkout')->group(function () {
        // Cart checkout - Reuses cart's delivery fee (cached for performance)
        // Returns: items, pricing summary with discount breakdown
        Route::get('/cart', [CheckoutController::class, 'getCartCheckout']);
        
        // Buy now checkout - Independent shipping calculation
        // Returns: product details, pricing with discounts, order summary
        Route::post('/buy-now', [CheckoutController::class, 'getBuyNowCheckout']);
        
        // Calculate shipping (optional utility endpoint)
        // Use for previewing shipping costs before checkout
        Route::post('/calculate-shipping', [CheckoutController::class, 'calculateShipping']);
        
        // Get available shipping tiers/options
        // Returns all configured shipping charges by product and quantity
        Route::get('/shipping-options', [CheckoutController::class, 'getShippingOptions']);
    });

    // ========================================
    // ORDER ROUTES
    // Order creation and management
    // ========================================
    Route::prefix('orders')->group(function () {
        // Get user's order history
        Route::get('/', [OrderController::class, 'getOrders']);
        
        // Create order from cart
        Route::post('/create', [OrderController::class, 'createOrder']);
        
        // Create order from buy now
        Route::post('/buy-now', [OrderController::class, 'buyNowOrder']);
        
        // Get single order details
        Route::get('/{orderCode}', [OrderController::class, 'getOrder']);
    });

    // ========================================
    // PAYMENT ROUTES
    // Payment processing with dynamic delivery fee
    // ========================================
    Route::prefix('payment')->group(function () {
        // Get available payment methods
        Route::get('/methods', [PaymentController::class, 'getPaymentMethods']);
        
        // Get payment details for order (includes delivery fee)
        Route::get('/{orderCode}', [PaymentController::class, 'getPaymentDetails']);
        
        // Confirm cash on delivery payment
        Route::post('/{orderCode}/cod', [PaymentController::class, 'confirmCOD']);
        
        // Initiate card payment (OnePay gateway)
        Route::post('/{orderCode}/card', [PaymentController::class, 'initiateCardPayment']);
        
        // Check payment status
        Route::get('/{orderCode}/status', [PaymentController::class, 'checkPaymentStatus']);
    });

    // ========================================
    // DASHBOARD ROUTES
    // User dashboard and order management
    // ========================================
    Route::prefix('dashboard')->group(function () {
        // Get dashboard overview (stats, recent orders, etc.)
        Route::get('/overview', [UserDashboardController::class, 'getDashboardOverview']);
        
        // Cancel order
        Route::post('/orders/{orderCode}/cancel', [UserDashboardController::class, 'cancelOrder']);
        
        // Confirm delivery received
        Route::post('/orders/{orderCode}/confirm-delivery', [UserDashboardController::class, 'confirmDelivery']);

        
    });

    // ========================================
    // INQUIRY ROUTES
    // Customer inquiries and support tickets
    // ========================================
    Route::prefix('inquiries')->group(function () {
        Route::get('/', [UserDashboardController::class, 'getInquiries']);
    });

    // ========================================
    // REVIEW ROUTES
    // Product reviews and ratings
    // ========================================
    Route::prefix('reviews')->group(function () {
        // Get user's reviews
        Route::get('/', [UserDashboardController::class, 'getReviews']);
        
        // Submit product review
        Route::post('/', [UserDashboardController::class, 'storeReview']);
    });

    // ========================================
    // ADDRESS ROUTES
    // User shipping/billing addresses management
    // ========================================
    Route::prefix('addresses')->group(function () {
        // Get all user addresses
        Route::get('/', [UserDashboardController::class, 'getAddresses']);
        
        // Create new address
        Route::post('/', [UserDashboardController::class, 'storeAddress']);
        
        // Update existing address
        Route::put('/{addressId}', [UserDashboardController::class, 'updateAddress']);
        
        // Delete address
        Route::delete('/{addressId}', [UserDashboardController::class, 'deleteAddress']);
    });

    // ========================================
    // BANNER ROUTES
    // Marketing banners for home page, categories, etc.
    // ========================================
    Route::get('/banners', [BannerController::class, 'getBanners']);
});
