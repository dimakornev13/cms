<?php


Route::group([], function () {
    Route::get('/', 'PageController@index');
    Route::get('{uri}', 'PageController@handle')->where('uri', '[0-9a-zA-Z\-\/_]+');
});
