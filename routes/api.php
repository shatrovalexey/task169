<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::post('resources', [Api::class, 'addResource',]);
Route::get('resources', [Api::class, 'getResources',]);
Route::post('bookings', [Api::class, 'addBooking',]);
Route::get('resources/{id}/bookings', [Api::class, 'getBookings',]);
Route::delete('resources/bookings/{id}', [Api::class, 'delBooking',]);