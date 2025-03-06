<?php

// import Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCOntroller;
use App\Http\Controllers\BlogController;

// import Facades
use App\Http\Controllers\CartController;

// import Middleware
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ShippoController;
use App\Http\Controllers\StripeController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminFAQController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\FusionFileController;
use App\Http\Controllers\Admin\PartsController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AssemblePartController;
use App\Http\Controllers\AdminSalesTaxController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\SimulationImageController;
use App\Http\Controllers\Admin\ManageTabsController;
use App\Http\Controllers\LayoutAttachmentController;
use App\Http\Controllers\PackagingProductController;
use App\Http\Controllers\SpeakerMakeModelController;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Admin\ProductPartsController;
use App\Http\Controllers\Frontend\SubscribeController;
use App\Http\Controllers\ProjectorMakeModelController;
use App\Http\Controllers\Frontend\AllProductsController;
use App\Http\Controllers\AdminProductAssociatedController;
use App\Http\Controllers\Frontend\AllProductsFilterController;
use App\Http\Controllers\Frontend\FreeQuote\FreeQuoteController;
use App\Http\Controllers\Frontend\ForgotPassword\ForgotPasswordController;
use App\Http\Controllers\Admin\Crm\HeaderNavigation\HeaderNavigationController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/shipping-calculator', function () {
    return view('shippo');
});

Route::get('/test-shippo', [ShippoController::class, 'createShipment']);
Route::post('/check-shipping', function (Request $request) {
    $response = Http::withHeaders([
        'Authorization' => 'ShippoToken ' . env('SHIPPO_API_KEY'),
        'Content-Type' => 'application/json'
    ])->post('https://api.goshippo.com/v1/validate/address', [
                'address_to' => [
                    'street1' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postalCode,
                    'country' => $request->country
                ]
            ]);

    return $response->json();
});
Route::get('/search-products', [AllProductsController::class, 'search'])->name('search.products');
Route::post('/subscribe', [SubscribeController::class, 'submit'])->name('subscribe');
Route::get('/about-us', [SubscribeController::class, 'aboutUs'])->name('about.us');
Route::get('/faq', [SubscribeController::class, 'faqPage'])->name('faqPage');
Route::get('/contacts', [SubscribeController::class, 'contacts'])->name('contacts');
Route::get('/privecy-policy', [SubscribeController::class, 'privecyPolicy'])->name('privecy.policy');
Route::get('/terms-and-condition', [SubscribeController::class, 'termsCondition'])->name('terms.condition');
Route::get('/paypal-payment', [PayPalController::class, 'createPayment'])->name('paypal.payment');
Route::post('/store-total-amount', [PayPalController::class, 'storeTotalAmount'])->name('store.totalAmount');

Route::get('/paypal-success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/paypal-cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');


Route::post('/stripe/payment', [StripeController::class, 'createPayment'])->name('stripe.payment');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::post('/braintree-payment', [PayPalController::class, 'braintreePayment'])->name('braintree.payment');
Route::get('/get-speaker-dimensions', [AllProductsController::class, 'getSpeakerDimensions'])->name('get.speaker.dimensions');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/get-projector-models', [AllProductsController::class, 'getProjectorModels'])->name('getProjectorModels');
Route::get('/get-centerchannel-models', [AllProductsController::class, 'getCenterChannelModels'])->name('getCenterChannelModels');


//Login

Route::post('/login', [AuthCOntroller::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthCOntroller::class, 'logout'])->name('logout');

Route::get('/register', [AuthCOntroller::class, 'register'])->name('register');
Route::post('/register-submit', [AuthCOntroller::class, 'registerSubmit'])->name('register.submit');
Route::get('/login', [AuthCOntroller::class, 'login_form'])->name('login');

Route::get('/order-success', function () {
    return view('order_success'); // Ensure this view exists
})->name('order.success');
Route::get('/braintree/token', [PaymentController::class, 'generateToken'])->name('braintree.token');
Route::get('/braintree/get-token', [PaymentController::class, 'token'])->name('braintree.gettoken');
Route::post('/braintree/checkout', [PaymentController::class, 'checkout'])->name('braintree.checkout');

Route::post('/braintree/payment', [PaymentController::class, 'braintree_payment'])->name('braintree.payment');
Route::get('/payment-success', [PaymentController::class, 'success'])->name('braintree.success');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('check-otp', [ForgotPasswordController::class, 'checkOtp'])->name('check.otp');

Route::post('check-otp-submit', [ForgotPasswordController::class, 'verifyOtp'])->name('check.otp.submit');

Route::get('reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password-update', [ForgotPasswordController::class, 'reset'])->name('password.update');
// General Routes

Route::get('/', [AllProductsController::class, 'index'])->name('all_products');
Route::get('/home', function(){
    return view('index');
})->name('home');

Route::get('/api/ceiling-height', [AllProductsFilterController::class, 'getCeilingHeight'])->name('ceiling.height');
Route::get('/api/screen-size', [AllProductsFilterController::class, 'getScreenSize'])->name('screen.size');
Route::get('/pages/free-quote', [FreeQuoteController::class, 'index'])->name('free_quote');

Route::post('/pages/free-quote-submit', [FreeQuoteController::class, 'submit'])->name('free_quote_submit');

Route::get('/products/{slug?}/{id}', [AllProductsController::class, 'show'])->name('product_details');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/get-shipping-rate', [ShippingController::class, 'getShippingRate'])->name('shipping.rate');


Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/get-location-from-postalcode/{postalcode}', [LocationController::class, 'getLocationFromPostalCode'])->name('location.fetch');





//Components Routes

// Quote Steps Routes
Route::get('/quote-step1', function () {
    return view('components.quote_step1');
})->name('quote_step1');

Route::get('/quote-step2', function () {
    return view('components.quote_step2');
})->name('quote_step2');

Route::get('/quote-step3', function () {
    return view('components.quote_step3');
})->name('quote_step3');





// Admin Routes with Middleware
// Route::middleware([EnsureUserIsAdmin::class])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.pages.dashboard');
//     })->name('dashboard');
//     Route::get('/projectors', [
//         ProjectorMakeModelController::class, 'index'
//     ])->name('projectors.index');
//     Route::delete('/projectors/{id}', [
//         ProjectorMakeModelController::class, 'destroy'
//     ])->name('projectors.delete');

//     Route::get('/admin-profile', function(){
//         return view('admin.pages.admin_profile');
//     })->name('admin_profile');

// });
Route::group(["middleware" => ["user.type.zero"]], function () {
    Route::get('/profile-dashboard', [ProfileController::class, 'index'])->name('profile');
    Route::get('/user/addresses', [UserAddressController::class, 'getUserAddresses'])->name('user.addresses');
    Route::get('/user/address/details', [UserAddressController::class, 'getAddressDetails'])->name('user.address.details');



    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/change/password', [ProfileController::class, 'changePassword'])->name('change.password');


    Route::post('/save-address', [ProfileController::class, 'saveAddress'])->name('save.address');

    Route::post('/update-address/{id}', [ProfileController::class, 'updateAddress'])->name('update.address');
    Route::post('/delete-address/{id}', [ProfileController::class, 'destroyAddress'])->name('delete.address');

});











Route::get('/api/projector-data', [AllProductsFilterController::class, 'getProjectorData'])->name('projector.data');
Route::get('/api/speaker-data', [AllProductsFilterController::class, 'getSpeakerData'])->name('speaker.data');

//advanced search
Route::get('/search', [AllProductsFilterController::class, 'search'])->name('product.search');
Route::get('/filter-projector-list', [AllProductsFilterController::class, 'filterProducts'])->name('filter.projector.list');

Route::get('/blogs/news/', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/news/{id}/{slug}', [BlogController::class, 'details'])->name('blogs.detail');
Route::get('/simulation-images/view', [SimulationImageController::class, 'viewImages'])->name('simulation_images.view');



Route::view('/demo', 'admin.pages.demo');
Route::get('/admin-login', [AdminLoginController::class, 'admin_login'])->name('admin_login')->middleware('auth.redirect');
Route::post('admin-login-check', [AdminLoginController::class, 'admin_login_check'])->name('admin_login_check')->middleware('auth.redirect');

Route::group(["as" => "admin.", "middleware" => ["admin-access"]], function () {
// Settings
Route::get('/admin/settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('settings.update');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin-logout', [AdminLoginController::class, 'admin_logout'])->name('admin_logout');
    // Blogs
    Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('blogs');
    Route::get('/admin/add/blogs', [AdminBlogController::class, 'add'])->name('blogs.add');
    Route::post('/admin/blogs/store', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('/admin/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/admin/blogs/{id}/update', [AdminBlogController::class, 'update'])->name('blogs.update');

    Route::delete('/admin/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');
    // Free Quote

    Route::get('/contact-us', [AdminDashboardController::class, 'contactUs'])->name('contactUs');
    Route::delete('/contact-us-delete/{id}', [AdminDashboardController::class, 'contactUsdelete'])->name('contactus.delete');
    // Header Navigation

    Route::get('/admin/header-navigation', [HeaderNavigationController::class, 'index'])->name('header.navigation');
    Route::get('/admin/add/header-navigation', [HeaderNavigationController::class, 'add'])->name('header.navigation.add');
    Route::post('/admin/header-navigation-store', [HeaderNavigationController::class, 'store'])->name('header.navigation.store');
    Route::get('/admin/header-navigation-edit/{id}', [HeaderNavigationController::class, 'edit'])->name('header.navigation.edit');
    Route::put('/admin/header-navigation-update/{id}', [HeaderNavigationController::class, 'update'])->name('header.navigation.update');
    Route::delete('/admin/header-navigation-delete/{id}', [HeaderNavigationController::class, 'destroy'])->name('header.navigation.destroy');
    // FAQ
    Route::get('/admin/faq', [AdminFAQController::class, 'index'])->name('faq');
    Route::get('/admin/add/faq', [AdminFAQController::class, 'add'])->name('faq.add');
    Route::post('/admin/faq/store', [AdminFAQController::class, 'store'])->name('faq.store');
    Route::get('/admin/faq/{id}/edit', [AdminFAQController::class, 'edit'])->name('faq.edit');
    Route::put('/admin/faq/{id}/update', [AdminFAQController::class, 'update'])->name('faq.update');
    Route::delete('/admin/faq/{id}', [AdminFAQController::class, 'destroy'])->name('faq.destroy');
    // SalesTax
    Route::get('/admin/sales_tax', [AdminSalesTaxController::class, 'index'])->name('sales_tax');
    Route::put('/admin/sales_tax/{id}/update', [AdminSalesTaxController::class, 'update'])->name('sales_tax.update');
    //Admin Profile

    Route::get('/admin-profile', function () {
        return view('admin.pages.admin_profile');
    })->name('admin_profile');


    // Projectors Make & Model
    Route::get('/projectors-make-and-model', [
        ProjectorMakeModelController::class,
        'index'
    ])->name('projectors.index');

    Route::post('/admin/projectors/store', [ProjectorMakeModelController::class, 'store'])->name('projectors.store');
    Route::put('/admin/projectors/{id}', [ProjectorMakeModelController::class, 'update'])->name('projectors.update');

    Route::delete('/projectors/{id}', [
        ProjectorMakeModelController::class,
        'destroy'
    ])->name('projectors.delete');


    // Center Channel Make & Model
    Route::get('/speaker-make-and-model', [
        SpeakerMakeModelController::class,
        'index'
    ])->name('speakers.index');
    Route::put('/admin/speakers/{id}', [SpeakerMakeModelController::class, 'update'])->name('speakers.update');

    Route::post('/admin/speakers/store', [SpeakerMakeModelController::class, 'store'])->name('speakers.store');
    Route::delete('/speakers/{id}', [
        SpeakerMakeModelController::class,
        'destroy'
    ])->name('speakers.delete');



    //Products
    Route::get('/add-product-info', [
        AdminProductController::class,
        'add'
    ])->name('products.add');
    Route::post('/admin/add/product/import', [AdminProductController::class, 'import'])->name('products.import');
    Route::get('admin/product/download-format', [AdminProductController::class, 'downloadFormat'])->name('products.download-format');

    Route::post('/add-product-submit', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/all-product-list', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('products/update', [AdminProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}', [
        AdminProductController::class,
        'destroy'
    ])->name('products.delete');
    Route::delete('/admin/products/all/delete', [AdminProductController::class, 'all_delete'])->name('products.deleteAll');

    // Product Images
    Route::get('/manage-images-of-child-products', [AdminProductController::class, 'child_index'])->name('products.child_index');
    Route::get('/edit-images-of-child-products/{id}', [AdminProductController::class, 'child_product_images_view'])->name('products.child_product_images.view');
    Route::post('/add-images-of-child-products', [AdminProductController::class, 'child_product_images_store'])->name('products.child_product_images.store');
    Route::get('/delete/product/images/{id}', [AdminProductController::class, 'destroy_image'])->name('products.child_product_images.delete');
    Route::post('/child/product/update/image', [AdminProductController::class, 'update_image'])->name('admin_product_update_image');

    Route::delete('/admin/products/child-product-images/delete-all/{product_id}',
    [AdminProductController::class, 'deleteAllImages']
)->name('products.child_product_images.deleteAll');

// Tabs
Route::get('/manage-tabs-products', [ManageTabsController::class, 'index'])->name('products.manage.tabs');
    Route::get('/products-description/{id}', [ManageTabsController::class, 'description'])->name('products.description');
    Route::post('/products-description-submit/{id}', [ManageTabsController::class, 'description_submit'])->name('products.description.submit');
    Route::get('/products-manual/{id}', [ManageTabsController::class, 'manual'])->name('products.manual');
    Route::post('/products-manual-submit/{id}', [ManageTabsController::class, 'manual_submit'])->name('products.manual.submit');
    Route::get('/products-article-videos/{id}', [ManageTabsController::class, 'artical'])->name('products.artical');
    Route::post('/products-artical-videos-submit/{id}', [ManageTabsController::class, 'articalSubmit'])->name('products.artical.submit');
    Route::post('/products-artical-delete-url', [ManageTabsController::class, 'deleteUrl'])->name('products.artical.deleteUrl');
    //Product Associated
    Route::post('/admin/simulation-images/update/{id}', [SimulationImageController::class, 'update'])->name('simulation_images.update');

    Route::post('/admin/simulation-images/store', [SimulationImageController::class, 'store'])->name('simulation_images.store');
    Route::get('/admin/simulation-images', [SimulationImageController::class, 'fetchImages'])->name('simulation_images.fetch');
    Route::delete('/admin/simulation-images/delete/{id}', [SimulationImageController::class, 'delete'])->name('simulation_images.delete');
    Route::get('/add-product-associated', [
        AdminProductAssociatedController::class,
        'add'
    ])->name('products_associated.add');
    Route::get('admin/product-associated/download-format', [AdminProductAssociatedController::class, 'downloadFormat'])->name('associated_parts.download-format');

    Route::post('/admin/add/product/associated/import', [AdminProductAssociatedController::class, 'import'])->name('associated_parts.import');

    Route::post('/add-product-associated-submit', [AdminProductAssociatedController::class, 'store'])->name('products_associated.store');
    Route::get('/all-product-associated-list', [AdminProductAssociatedController::class, 'index'])->name('products_associated.index');
    Route::post('products_associated/update', [AdminProductAssociatedController::class, 'update'])->name('products_associated.update');
    Route::get('/products_associated/{id}', [
        AdminProductAssociatedController::class,
        'destroy'
    ])->name('products_associated.delete');
    Route::delete('/admin/product-associated/all/delete', [AdminProductAssociatedController::class, 'all_delete'])->name('product_associated.deleteAll');

    Route::get('/get-models/{make}', [AdminProductAssociatedController::class, 'getModels'])->name('products_associated.getModels');
    //Fusion Attachments
    Route::get('/view-fusion-attachments', [
        FusionFileController::class,
        'index'
    ])->name('fusion.attachment');

    Route::get('/add-fusion-attachment-details', [
        FusionFileController::class,
        'add'
    ])->name('fusion.add');
    Route::post('/admin/product-fusion-details/import', [FusionFileController::class, 'import'])->name('fusion.import');

    Route::put('fusion/update/{id}', [FusionFileController::class, 'update'])->name('fusion.update');
    Route::get('admin/fusion/download-format', [FusionFileController::class, 'downloadFormat'])->name('fusion.download-format');


    Route::delete('fusion/delete/{id}', [FusionFileController::class, 'destroy'])->name('fusion.delete');


    // Layout Attachment
    Route::get('/view-layout-attachments', [
        LayoutAttachmentController::class,
        'index'
    ])->name('layout.attachment');

    Route::get('/add-layout-attachment-details', [
        LayoutAttachmentController::class,
        'add'
    ])->name('layout.add');
    Route::post('/admin/product-layout-details/import', [LayoutAttachmentController::class, 'import'])->name('layout.import');

    Route::put('layout/update/{id}', [LayoutAttachmentController::class, 'update'])->name('layout.update');
    Route::get('admin/layout/download-format', [LayoutAttachmentController::class, 'downloadFormat'])->name('layout.download-format');


    Route::delete('layout/delete/{id}', [LayoutAttachmentController::class, 'destroy'])->name('layout.delete');








    //Packaging Products

    Route::get('/add-product-package-details', [
        PackagingProductController::class,
        'add'
    ])->name('package.add');

    Route::post('/admin/product-package-details/import', [PackagingProductController::class, 'import'])->name('package.import');

    Route::get('/package-details', [
        PackagingProductController::class,
        'index'
    ])->name('package.index');
    Route::get('admin/packages/download-format', [PackagingProductController::class, 'downloadFormat'])->name('packages.download-format');
    Route::put('packages/update/{id}', [PackagingProductController::class, 'update'])->name('package.update');


    Route::delete('packages/delete/{id}', [PackagingProductController::class, 'destroy'])->name('package.delete');
    // Assemble Parts
    Route::get('/add-assemble-parts-details', [
        AssemblePartController::class,
        'add'
    ])->name('assemble.add');

    Route::get('/assemble-details', [
        AssemblePartController::class,
        'index'
    ])->name('assemble.index');
    Route::get('admin/assemble/download-format', [AssemblePartController::class, 'downloadFormat'])->name('assemble.download-format');
    Route::post('/admin/assemble-parts-details/import', [AssemblePartController::class, 'import'])->name('assemble.import');
    Route::put('assemble/update/{id}', [AssemblePartController::class, 'update'])->name('assemble.update');


    Route::delete('assemble/delete/{id}', [AssemblePartController::class, 'destroy'])->name('assemble.delete');

    // Parts

    Route::get('/parts', [
        PartsController::class,
        'index'
    ])->name('parts.index');
    Route::get('/add-parts', [
        PartsController::class,
        'add'
    ])->name('parts.add');
    Route::get('admin/parts/download-format', [PartsController::class, 'downloadFormat'])->name('parts.download-format');
    Route::post('/parts-submit', [PartsController::class, 'storePart'])->name('parts.store');
    // Route to show the edit form (returning JSON data)
    Route::get('admin/parts/{part}/edit', [PartsController::class, 'edit'])->name('parts.edit');

    Route::put('admin/parts/{part}', [PartsController::class, 'update'])->name('parts.update');

    Route::delete('/admin/parts/{id}', [PartsController::class, 'destroy'])->name('parts.delete');

    Route::post('/admin/parts/import', [PartsController::class, 'import'])->name('parts.import');
    Route::delete('/admin/parts/all/delete', [PartsController::class, 'all_delete'])->name('parts.deleteAll');

    //product Parts


    Route::get('/product-parts-index', [
        ProductPartsController::class,
        'index'
    ])->name('product_parts.index');
    Route::get('admin/product-parts/download-format', [ProductPartsController::class, 'downloadFormat'])->name('product_parts.download-format');

    Route::post('/admin/add/product/parts/import', [ProductPartsController::class, 'import'])->name('product_parts.import');

    Route::get('/add-product-parts', [
        ProductPartsController::class,
        'add'
    ])->name('product_parts.add');

    Route::get('/part-details', [ProductPartsController::class, 'getPartDetails'])->name('part-details');
    Route::post('/part-details-submit-form', [ProductPartsController::class, 'store'])->name('product_parts.store');


    Route::get('/admin/product_parts/{id}/edit', [ProductPartsController::class, 'edit'])->name('product_parts.edit');
    Route::put('/admin/product_parts/{id}/update', [ProductPartsController::class, 'update'])->name('product_parts.update');

    Route::delete('/admin/product-parts/delete/{id}', [ProductPartsController::class, 'destroy'])->name('product_parts.delete');
    Route::delete('/admin/product-parts/all/delete', [ProductPartsController::class, 'all_delete'])->name('product_parts.deleteAll');

});


