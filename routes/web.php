<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VideoCategoryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
    Route::post('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('/'.__('site.studio-rental'), [HomeController::class, 'studio'])->name('studio');
    Route::get('/p/{slug}', [HomeController::class, 'studio_detail'])->name('studio.detail');
    Route::get('/services', [HomeController::class, 'services'])->name('services');

    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
    Route::get('/video', [HomeController::class, 'video'])->name('video');

    Route::get('/projects', [HomeController::class, 'foto'])->name('foto');
    Route::get('/projects/{slug}', [HomeController::class, 'foto_gallery'])->name('gallery.detail');
    Route::get('/projects/{slug}/{title}', [HomeController::class, 'foto_detail'])->name('foto.detail');

    Route::get('/project', [HomeController::class, 'project'])->name('project');
    Route::get('/kinefinity-cinema-camera', [HomeController::class, 'kinefinity'])->name('kinefinity');

    Route::get('/brands', [HomeController::class, 'brands'])->name('brands');
    Route::get('/brand/{url}', [HomeController::class, 'brand'])->name('brand');

    Route::get('/rentals', [HomeController::class, 'rental'])->name('rental');
    Route::get('/rentals/{url}', [HomeController::class, 'rentals'])->name('rentals');
    Route::get('/rentals/{categoryslug}/{productslug}', [HomeController::class, 'product'])->name('product');

    Route::post('/mailsubscribe', [HomeController::class, 'mailsubscribe'])->name('mailsubscribe');
    Route::post('/search', [HomeController::class, 'search'])->name('search');

    Route::post('/addtocart/{productslug}/{categoryslug}', [HomeController::class, 'addtocart'])->name('addtocart');
    Route::post('/deletecart/{productslug}', [HomeController::class, 'deletecart'])->name('deletecart');
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/wishlistsave', [HomeController::class, 'wishlistsave'])->name('wishlist.save');

    Route::get('/success', [HomeController::class, 'success'])->name('success');

});


Route::group(["prefix"=>"go", 'middleware' => ['auth','web', 'admin']],function() {
    Route::get('/', [DashboardController::class, 'index'])->name('go');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::auto('/page', PageController::class);
    Route::auto('/pagecategory', PageCategoryController::class);
    Route::auto('/product', ProductController::class);
    Route::auto('/productcategory', ProductCategoryController::class);
    Route::auto('/blog', BlogController::class);
    Route::auto('/blog-categories', BlogCategoryController::class);
    Route::auto('/faq', FaqController::class);
    Route::auto('/faq-categories', FaqCategoryController::class);
    Route::auto('/service', ServiceController::class);
    Route::auto('/servicecategory', ServiceCategoryController::class);
    Route::auto('/gallery', GalleryController::class);
    Route::auto('/gallery-categories', GalleryCategoryController::class);
    Route::auto('/slider', SliderController::class);
    Route::auto('/video', VideoController::class);
    Route::auto('/video-categories', VideoCategoryController::class);
    Route::auto('/settings', SettingController::class);
    Route::auto('/contact', ContactController::class);
    Route::auto('/features', FeaturesController::class);
    Route::auto('/reference', ReferenceController::class);
    Route::auto('/brand', BrandController::class);
    Route::auto('/wishlist', WishlistController::class);
});

require __DIR__.'/auth.php';
