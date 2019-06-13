<?php

namespace Grafline\NovaPoshta;


use Illuminate\Http\Request;

class NovaPoshta
{

    protected $np;

    function __construct()
    {
       
    }

    public function cities(){
        return $this->getCities()['data'];

    }

}