<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controller\ApiController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('v1/on-covid-19', 'ApiController@getEstimate');
Route::post('v1/on-covid-19/json', 'ApiController@getEstimate');
Route::post('v1/on-covid-19/xml', 'ApiController@getEstimateXml');
Route::get('v1/on-covid-19/logs', 'ApiController@getAllLogs()');
