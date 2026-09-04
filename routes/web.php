<?php

use App\Http\Controllers\PortfolioDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('portfolio-details.index');
});

Route::resource('portfolio-details', PortfolioDetailController::class);
