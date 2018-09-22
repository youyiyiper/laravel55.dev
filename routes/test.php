<?php

//测试
Route::get('test/upload','TestController@upload');
Route::post('test/doUpload','TestController@doUpload');

//excel
Route::get('excel/export','ExcelController@export');
Route::get('excel/import','ExcelController@import');

//测试
Route::get('redis','RedisController@index');