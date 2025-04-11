<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RoomController;


Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('/about', [Controller::class, 'about'])->name('about-us');
Route::get('/forgot-password', [Controller::class, 'forgot'])->name('forgot');
Route::post('/forgot-password', [Controller::class, 'postForgotPassword']);
Route::get('/reset/{token}', [Controller::class, 'reset']);
Route::post('/reset/{token}', [Controller::class, 'postReset'])->name('postReset');;
Route::post('/forgot-password', [Controller::class, 'postForgotPassword']);
Route::post('/update_account', [Controller::class, 'postUpdateAccount'])->name('update_account');

Route::group(['prefix'=>'cart'],function(){
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::get('/add_to_cart/{room_id}', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update_cart');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove_from_cart');
    Route::post('/session', [CartController::class, 'session'])->name('session');
});

Route::get('/book', [BookController::class, 'book'])->name('book');
Route::post('/search', [BookController::class, 'search'])->name('search');
Route::post('/searchajax', [BookController::class, 'suggestions'])->name('searchajax');
Route::get('/detail/{HotelID}', [BookController::class, 'detail'])->name('detail');
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout'])->name('logout-checkout');
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout'])->name('login-checkout');
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/add-customer', [CheckoutController::class, 'viewregister'])->name('viewregister');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/confirm-booking', [CheckoutController::class, 'confirm_booking']);
Route::get('/account', [CheckoutController::class, 'account'])->name('account');

Route::get('/blogg', [ContactUsController::class, 'blog'])->name('blog-review');
Route::get('/banhmi', [Controller::class, 'banhmi'])->name('banhmi');
Route::post('/blogg', [ContactUsController::class, 'postBlog']);


Route::post('/checkout_online', [CheckoutController::class, 'checkout_online'])->name('checkout_online');

Route::get('/contact', [ContactUsController::class, 'contact'])->name('contact-us');
Route::post('/contact', [ContactUsController::class, 'postContact']);

Route::get('/adminlogout', [AdminController::class, 'adminlogout'])->name('adminlogout');

Route::prefix('admin') ->middleware('admin')->group(function(){
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.admin1');
});

// -----------------------------Admin----------------------------------------//
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::GET('/dashboard', [AdminController::class, 'dashboard'])->middleware('requireLogin')->name('dashboard');
Route::post('/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
Route::get('/admin-dashboard', [AdminController::class, 'load_dashboard'])->name('Load_dashboard');
Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');
Route::get('/profile', [AdminController::class, 'profile'])->name('profile');

// -----------------------------login----------------------------------------//
Route::get('/admin_login', [AdminController::class, 'admin_login'])->name('login');
Route::get('/adminlogout', [AdminController::class, 'adminlogout'])->name('adminlogout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// // ----------------------------- Hotels -----------------------------//
Route::get('/add-hotel', [AdminController::class, 'addHotels'])->name('Add-Hotels');
Route::get('/all-hotel', [HotelController::class, 'getAllHotels'])->name('All-Hotels');
Route::get('/edit-hotel/{HotelID}', [HotelController::class, 'updateHotels'])->name('Edit-Hotels');

Route::post('/save-Hotel', [HotelController::class, 'saveHotels'])->name('Save-Hotels');
Route::post('/updated-Hotel', [HotelController::class, 'updatedHotels'])->name('Updated-Hotels');
Route::post('/delete-hotel', [HotelController::class, 'deleteHotels'])->name('Delete-Hotels');
Route::post('/update-number-of-rooms', [HotelController::class, 'updateNumberOfRooms']);


// ----------------------------- booking -----------------------------//
Route::get('/all-booking', [BookingController::class, 'allbooking'])->name('form/allbooking');
Route::get('form/booking/edit/{bkg_id}', [BookingController::class, 'bookingEdit']);
Route::get('/add-booking', [BookingController::class, 'getAll_Infor_Booking'])->name('form/booking/add');
Route::get('/get-booking-info/{user_id}', [BookingController::class, 'getBookingInfo'])->name('get-booking-info');
Route::get('/print-order/{invoice_id}', [BookingController::class, 'print_order'])->name('print/order');

Route::get('/admin/confirm-booking', [BookingController::class, 'confirmBooking'])->name('confirm-booking');
Route::post('/admin/confirm-booking-action', [BookingController::class, 'confirmBookingAction'])->name('confirm-booking-action');

// Route::get('/all-Users', [BookController::class, 'getAllUsers'])->name('All-Users');
Route::get('/booking-confirmed/{book_details_id}', [BookingController::class, 'booking_confirmed']);
Route::get('/booking-not-confirmed/{book_details_id}', [BookingController::class, 'booking_notconfirmed']);
Route::get('/get-room-types',  [BookingController::class, 'getRoomTypes'])->name('getRoomTypes');

Route::post('/updateSelectedHotel', [BookingController::class, 'updateSelectedHotel']);
Route::post('form/booking/save', [BookingController::class, 'saveBooking'])->name('form/booking/save');
// Route::post('form/booking/update', [App\Http\Controllers\BookingController::class, 'updateRecord'])->middleware('auth')->name('form/booking/update');
// Route::post('form/booking/delete', [App\Http\Controllers\BookingController::class, 'deleteRecord'])->middleware('auth')->name('form/booking/delete');

// ----------------------------- Account-Users -----------------------------//
Route::get('/add-users', [AccountController::class, 'addUsers'])->name('Add-Users');
Route::get('/all-users', [AccountController::class, 'allUsers'])->name('form/allusers');
Route::get('/edit-users/{id}', [AccountController::class, 'updateUsers'])->name('Edit-Users');
Route::delete('/delete-user/{id}', [AccountController::class, 'deleteUser'])->name('delete-user');

Route::post('save-users', [AccountController::class, 'saveUsers'])->name('form/addcustomer/save');
Route::post('/updated-users', [AccountController::class, 'updatedUsers'])->name('Updated-Users');

Route::get('/all-Invoices', [AccountController::class, 'allinvoices'])->name('form/allinvoices');
Route::get('/all-payments', [AccountController::class, 'payments'])->name('form/payments');

Route::get('form/customer/edit/{bkg_customer_id}', [AccountController::class, 'updateCustomer']);
// Route::post('form/customer/update', [App\Http\Controllers\CustomerController::class, 'updateRecord'])->middleware('auth')->name('form/customer/update');
// Route::post('form/customer/delete', [App\Http\Controllers\CustomerController::class, 'deleteRecord'])->middleware('auth')->name('form/customer/delete');

// // ----------------------------- rooms -----------------------------//
Route::get('/add-room', [RoomController::class, 'addRooms'])->name('form/addroom/page');
Route::get('/get-hotel-info/{hotelID}', [RoomController::class, 'getHotelInfo'])->name('get-hotel-info');
Route::get('/all-room', [RoomController::class, 'getAllRooms'])->name('form/allrooms/page');
// Route::get('form/room/edit/{bkg_room_id}', [RoomController::class, 'editRoom']);
Route::get('/edit-room/{room_id}', [RoomController::class, 'updateRooms'])->name('Edit-Room');
Route::get('/active/{roomID}', [RoomController::class, 'room_status_active']);
Route::get('/inactive/{rooID}', [RoomController::class, 'room_status_inactive']);


Route::post('/save-room', [RoomController::class, 'saveRooms'])->name('form/room/save');
Route::post('form/room/delete', [RoomController::class, 'deleteRooms'])->name('form/room/delete');
Route::post('form/room/update', [RoomController::class, 'updatedRooms'])->name('form/room/update');


?>
