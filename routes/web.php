<?php

use App\Http\Controllers\AgeController;
use App\Http\Middleware\CheckAge;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

// About and Contact routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/ageverification', function () {
    return view('ageverification');
})->name('ageverification');

// Route group applying the CheckAge middleware
Route::middleware(['check.age:21'])->group(function () {
    Route::get('/home', function () {
        return view('home'); 
    })->name('home');
});

Route::middleware(['log.requests'])->group(function () {
    Route::get('/', function () {
        return view('ageverification');
    })->name('ageverification');
});

    // HomeController for index
Route::get('/', [HomeController::class, 'index'])->name('home');
    // Route for adding items to the order
Route::post('/order/add', [OrderController::class, 'add'])->name('order.add');

// Contact submission
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Place an order
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

// Cancel an order
Route::post('/order/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

// Route for checking age (form submission)
Route::get('/check-age', function (Request $request) {
    $age = $request->query('age'); // Get age from query parameter

    // Redirect to the welcome route with the age
    return redirect()->route('welcome', ['age' => $age]);
})->name('check.age');

// The welcome route with CheckAge middleware applied
Route::middleware(['check.age'])->get('/welcome', function (Request $request) {
    return view('welcome', ['age' => $request->query('age')]); // Pass the age to the view
})->name('welcome');

// Access Denied route
Route::get('/access-denied', function () {
    return view('access-denied'); // Corrected view name
})->name('access.denied');