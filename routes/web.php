<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;

Route::get('/', function () {
    $destinations = \App\Models\Destination::withCount('bookings')
        ->orderByDesc('bookings_count')
        ->orderByDesc('is_special_offer')
        ->orderByDesc('discount_price')
        ->take(6)
        ->get();
    return view('welcome', compact('destinations'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/bookings', [ProfileController::class, 'bookings'])->name('profile.bookings');
    Route::get('/profile/saved-places', [ProfileController::class, 'savedPlaces'])->name('profile.saved-places');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/destinations/create', [DestinationController::class, 'create']);
    Route::post('/destinations', [DestinationController::class, 'store']);

    Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit']);
    Route::put('/destinations/{id}', [DestinationController::class, 'update']);
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy']);

    
    Route::get('/bookings/checkout', [\App\Http\Controllers\BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::post('/bookings/store', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}/payment', [\App\Http\Controllers\BookingController::class, 'payment'])->name('bookings.payment');
    Route::post('/bookings/{id}/payment', [\App\Http\Controllers\BookingController::class, 'confirmPayment'])->name('bookings.confirmPayment');
    Route::get('/bookings/{id}/success', [\App\Http\Controllers\BookingController::class, 'success'])->name('bookings.success');
    Route::post('/bookings/{id}/cancel', [\App\Http\Controllers\BookingController::class, 'requestCancellation'])->name('bookings.cancel');
});

Route::middleware('auth')->group(function () {
    // Chat Routes
    Route::get('/chat/messages', [\App\Http\Controllers\ChatController::class, 'fetchUserMessages'])->name('chat.messages');
    Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendUserMessage'])->name('chat.send');

    // Invoice Route
    Route::get('/bookings/{id}/invoice', [\App\Http\Controllers\BookingController::class, 'invoice'])->name('bookings.invoice');
});

Route::get('/special-offers', [DestinationController::class, 'specialOffers'])->name('special-offers');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/recommendations', [DestinationController::class, 'recommend'])->name('destinations.recommend');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    
    Route::get('/products', [\App\Http\Controllers\Admin\DestinationController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\Admin\DestinationController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\Admin\DestinationController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [\App\Http\Controllers\Admin\DestinationController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [\App\Http\Controllers\Admin\DestinationController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [\App\Http\Controllers\Admin\DestinationController::class, 'destroy'])->name('products.destroy');

    
    Route::get('/orders', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('orders.index');
    Route::get('/orders/export', [\App\Http\Controllers\Admin\BookingController::class, 'export'])->name('orders.export');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/confirm', [\App\Http\Controllers\Admin\BookingController::class, 'confirm'])->name('orders.confirm');
    Route::patch('/orders/{id}/confirm-dp', [\App\Http\Controllers\Admin\BookingController::class, 'confirmDp'])->name('orders.confirmDp');
    Route::patch('/orders/{id}/confirm-pelunasan', [\App\Http\Controllers\Admin\BookingController::class, 'confirmPelunasan'])->name('orders.confirmPelunasan');
    Route::patch('/orders/{id}/approve-cancellation', [\App\Http\Controllers\Admin\BookingController::class, 'approveCancellation'])->name('orders.approveCancellation');
    Route::patch('/orders/{id}/reject-cancellation', [\App\Http\Controllers\Admin\BookingController::class, 'rejectCancellation'])->name('orders.rejectCancellation');

    // Admin Chat Routes
    Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'adminIndex'])->name('chats.index');
    Route::get('/chats/list', [\App\Http\Controllers\ChatController::class, 'adminFetchActiveChats'])->name('chats.list');
    Route::get('/chats/{userId}/messages', [\App\Http\Controllers\ChatController::class, 'adminFetchMessages'])->name('chats.messages');
    Route::post('/chats/{userId}/send', [\App\Http\Controllers\ChatController::class, 'adminSendMessage'])->name('chats.send');


});
require __DIR__.'/auth.php';
