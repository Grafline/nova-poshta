<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 16.06.19
 * Time: 12:10
 */

namespace Grafline\NovaPoshta\Facades;


use Illuminate\Support\Facades\Facade;

class NovaPoshta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nova_poshta';
    }
}