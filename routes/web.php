<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\backend\PropertyController;
use App\Http\Controllers\backend\PropertyTypeController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [UserController::class, "index"])->name("user.dashboard");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});

Route::middleware(["auth", "role:admin"])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});

Route::middleware(["auth", "role:agent"])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'Dashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
});


Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);


Route::middleware(["auth", "role:admin"])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type');
        Route::get('/add/type', 'AddType')->name('add.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
    });
});

Route::middleware(["auth", "role:admin"])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenity', 'AllAmenity')->name('all.amenity');
        Route::get('/add/amenity', 'AddAmenity')->name('add.amenity');
        Route::get('/edit/amenity/{id}', 'EditAmenity')->name('edit.amenity');
        Route::get('/delete/amenity/{id}', 'DeleteAmenity')->name('delete.amenity');
        Route::post('/store/amenity', 'StoreAmenity')->name('store.amenity');
        Route::post('/update/amenity', 'UpdateAmenity')->name('update.amenity');
    });
});

//property All route
Route::middleware(["auth", "role:admin"])->group(function () {
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multiimage', 'UpdatePropertyMultiImage')->name('update.property.multiimage');
        Route::post('/store/new/multiimage', 'StoreNewMultiImage')->name('store.new.multiimage');
        Route::post('/update/property/Facilities', 'UpdatePropertyFacilities')->name('update.property.facilities');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::get('/delete/property/multiimage/{id}', 'PropertyMultiImageDelete')->name('delete.property.multiimage');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::post('/inactive/property', 'InactiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');

        Route::get("admin/package/history", "AdminPackageHistory")->name("admin.package.history");
        Route::get("admin/package/history/invoice/{id}", "AdminPackageHistoryInvoice")->name("admin.package.history.invoice");
        Route::get("admin/property/message", "AdminPropertyMessage")->name("admin.property.message");
    });
});


//Agent manage All route
Route::middleware(["auth", "role:admin"])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/agent', 'AllAgent')->name('all.agent');
        Route::get('/add/agent', 'AddAgent')->name('add.agent');
        Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent');
        Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get("/changeStatus", "changeStatus");
    });
});

Route::middleware(["auth", "role:agent"])->group(function () {
    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('/agent/all/property', 'AgentAllProperty')->name('agent.all.property');
        Route::get('/agent/add/property', 'AgentAddProperty')->name('agent.add.property');
        Route::post('/agent/store/property', 'AgentStoreProperty')->name('agent.store.property');
        Route::get('/agent/edit/property/{id}', 'AgentEditProperty')->name('agent.edit.property');
        Route::post('/agent/update/property', 'AgentUpdateProperty')->name('agent.update.property');
        Route::post('/agent/update/property/thumbnail', 'AgentUpdatePropertyThumbnail')->name('agent.update.property.thumbnail');
        Route::post('/agent/update/property/multiimage', 'AgentUpdatePropertyMultiimage')->name('agent.update.property.multiimage');
        Route::get('/agent/delete/property/multiimage/{id}', 'AgentDeletePropertyMultiimage')->name('agent.delete.property.multiimage');
        Route::post('/agent/store/new/multiimage', 'AgentStoreNewMultiimage')->name('agent.store.new.multiimage');
        Route::post('/agent/update/property/facilities', 'AgentUpdatePropertyFacilities')->name('agent.update.property.facilities');

        Route::get('/agent/details/property/{id}', 'AgentDetailsProperty')->name('agent.details.property');
        Route::get('/agent/delete/property/{id}', 'AgentDeleteProperty')->name('agent.delete.property');
        Route::get('/agent/property/message', 'AgentPropertyMessage')->name('agent.property.message');
        Route::get('/agent/message/details/{id}', 'AgentMessageDetails')->name('agent.message.details');
    });
});

//agent buy package
Route::controller(AgentPropertyController::class)->group(function () {
    Route::get('/buy/package', 'BuyPackage')->name('buy.package');
    Route::get('/buy/business/plan', 'BuyBusinessPlan')->name('buy.business.plan');
    Route::post('/store/business/plan', 'StoreBusinessPlan')->name('store.business.plan');
    Route::get('/buy/professional/plan', 'BuyProfessionalPlan')->name('buy.professional.plan');
    Route::post('/store/professional/plan', 'StoreProfessionalPlan')->name('store.professional.plan');
    Route::get('/package/history', 'PackageHistory')->name('package.history');
    Route::get('/package/history/invoice/{id}', 'PackageHistoryInvoice')->name('package.history.invoice');
});


require __DIR__ . '/auth.php';

Route::controller(IndexController::class)->group(function () {
    Route::get("/property/details/{id}/{slug}", "PropertyDetails")->name("property.details");
    Route::post("/send/massage", "SendMassage")->name("send.message");
});

//wishlist route 
Route::post("/add-to-wishlist/{property_id}", [WishlistController::class, "AddWishlist"]);

//Wishlist All Route
Route::middleware('auth')->group(function () {
    Route::get('/user/wishlist', [WishlistController::class, 'UserWishlist'])->name('user.wishlist');
    Route::get('/get-all-wishlist/', [WishlistController::class, 'GetAllWishlist']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlist']);
});

//Compare all route
Route::post("/add-to-compare/{property_id}", [CompareController::class, "AddToCompare"]);

//compare route
Route::middleware('auth')->group(function () {
    Route::get('/user/compare', [CompareController::class, 'UserCompare'])->name('user.compare');
    Route::get('/get-all-compare/', [CompareController::class, 'GetAllCompare']);
    Route::get('/compare-remove/{id}', [CompareController::class, 'RemoveCompare']);
});
