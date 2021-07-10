<?php


Route::group([], function () {
    Route::get('/', 'PageController@index');
    Route::get('{url}', 'PageController@handle')->where('url', '[0-9a-zA-Z\-\/_]+');
});
