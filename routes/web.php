<?php

Route::get('/', 'IndexController@index')->name('index');
Route::post('/make-payment', 'IndexController@makePayment')->name('index.make.payment');
Route::post('/make-purchase', 'IndexController@makePurchase')->name('index.make.purchase');
Route::post('/money-back', 'IndexController@moneyBack')->name('index.money.back');