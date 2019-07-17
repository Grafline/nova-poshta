<?php

Route::post('/ajax_get_cites', function (\Illuminate\Http\Request $request){
    return (new \Grafline\NovaPoshta\NovaPoshta())->getCities($request);
});

Route::post('/ajax_get_warehouses', function (\Illuminate\Http\Request $request){
    return (new \Grafline\NovaPoshta\NovaPoshta())->getWarehouses($request);
});

Route::post('/ajax_get_warehouses_key', function (\Illuminate\Http\Request $request){
    return (new \Grafline\NovaPoshta\NovaPoshta())->getWarehousesKey($request);
});
