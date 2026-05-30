<?php

use App\Http\Controllers\Admin\SeasonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:super_admin,admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::inertia('/', 'admin/Dashboard')->name('dashboard');

        Route::resource('seasons', SeasonController::class)->except(['show']);

        Route::inertia('players', 'admin/Players')->name('players.index');
        Route::inertia('teams', 'admin/Teams')->name('teams.index');
        Route::inertia('pools', 'admin/Pools')->name('pools.index');
        Route::inertia('auction', 'admin/Auction')->name('auction.index');
        Route::inertia('fixtures', 'admin/Fixtures')->name('fixtures.index');
    });
