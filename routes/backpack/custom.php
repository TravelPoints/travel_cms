<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('tour', 'TourCrudController');
    Route::crud('tour_guides', 'Tour_guidesCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('city', 'CityCrudController');
    Route::crud('language', 'LanguageCrudController');
    Route::crud('tour_guides_langs', 'Tour_guides_langsCrudController');
    Route::crud('tour_points', 'Tour_pointsCrudController');
}); // this should be the absolute last line of this file