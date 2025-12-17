<?php

use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('shorten'); 
});
Route::post('/api/shorten',
 [ShortLinkController::class, 'shorten']);


Route::get('/r/{shortCode}',
 [ShortLinkController::class, 'redirect']);

 
Route::get('/api/urls',
 [ShortLinkController::class, 'show']);