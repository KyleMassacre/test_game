<?php

Route::prefix('/')->group(function() {
   Route::get('/', 'Dashboard\DashboardController@index')->name('admin.home');
});
