<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;

Route::get('/', function () {
    return view('electo.pages.home');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('organizations.index');
    })->name('dashboard');

    Route::resource('organizations', OrganizationController::class);

});

require __DIR__.'/auth.php';