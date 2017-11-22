<?php

Route::get('/', 'principalController@index');

Route::get('/evaluacion', 'principalController@evaluacion');

Route::get('/revision', 'principalController@revision');

Route::get('/corregir', 'principalController@corregir');

Route::post('/data', 'principalController@recibir_data');

Route::post('/login', 'principalController@login');

Route::get('/logout', 'principalController@logout');

Route::get('/asignar/{id}/{val}', 'principalController@asignar');