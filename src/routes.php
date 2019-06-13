<?php

Route::post('/ajax_get_cites', function (){
    return (new \LisDev\NovaPoshta())->cities();
});
