<?php

Route::get('/', \M0xy\Cms\Controllers\PageController::class . '@index');
Route::get('{url}', \M0xy\Cms\Controllers\PageController::class . '@handle')->where('url', '[0-9a-zA-Z\-\/_]+');