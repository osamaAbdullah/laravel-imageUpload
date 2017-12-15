<?php


use Intervention\Image\Image;

Route::get('/', function () {
    return view('welcome');
});

Route::post('save/image','ImageController@store')->name('saveImage');

Route::get('image/{image}','ImageController@show')->name('showImage');

Route::get('image/edit/{image}','ImageController@edit')->name('editImage');

Route::post('image/{image}','ImageController@update')->name('updateImage');

Route::get('image/view/{image}','ImageController@get')->name('getImage');